<?php

namespace App\Trait\CRUD;

use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\InteractsWithMedia;

trait CrudOparation
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $modelName
     * @param  array  $data
     * @param  string  $directory
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeModel(string $modelName, array $data, $afterCreate = null)
    {
        $request = request();
        $onlyModelName = last(explode('\\', $modelName));
        try {
            DB::beginTransaction();
            $model = $modelName::create($data);
            if ($request->hasFile('image')) {
                ImageHelper::uploadImage($model, $request, 'image');
            }
            if ($request->hasFile('multiple_image')) {
                 ImageHelper::uploadMultipleImages($model, $request, 'multiple_image');
             }
            if ($afterCreate && is_callable($afterCreate)) {
                call_user_func($afterCreate, $model);
            }
            DB::commit();
           return back()->with('success', ucfirst($onlyModelName) . ' created successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', ucfirst($onlyModelName) . 'Failed to create ' . strtolower($onlyModelName) . ': ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $modelName
     * @param  string  $id
     * @param  array  $data
     * @param  string  $directory
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateModel(string $modelName, string $id, array $data, $afterCreate = null)
    {
        $onlyModelName = last(explode('\\', $modelName));
        $request = request();
        $model = $modelName::find($id);

        if (!$model) {
            return back()->with('sucerrorcess',  ucfirst($onlyModelName) . ' not found.');
        }

        try {
            DB::beginTransaction();
            $model->update($data);
            if ($request->hasFile('image')) {
                if ($model->hasMedia('image')) {
                    $model->clearMediaCollection('image');
                }
                 ImageHelper::uploadImage($model, $request, 'image');
             }
            if ($request->hasFile('multiple_image')) {
                if ($model->hasMedia('multiple_image')) {
                    $model->clearMediaCollection('multiple_image');
                }
                 ImageHelper::uploadMultipleImages($model, $request, 'multiple_image');
             }

             if ($afterCreate && is_callable($afterCreate)) {
                call_user_func($afterCreate, $model);
            }
            DB::commit();
             return back()->with('success', ucfirst($onlyModelName) . ' updated successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            return back()->with('suerrorccess', 'Failed to update ' . strtolower($onlyModelName) . ': ' . $e->getMessage());
        }
    }


    public function destroyModel(string $id,string $modelName)
    {
        $onlyModelName = last(explode('\\', $modelName));
        $model = $modelName::find($id);

        if (!$model) {
            return response()->json([
                'status' => 'error',
                'message' => ucfirst($onlyModelName) . ' not found.'
            ], 404);
        }

        try {
            if (in_array(InteractsWithMedia::class, class_uses($model)) && $model->hasMedia()) {
                $model->clearMedia();
            }
            $model->delete();
            return response()->json([
                'status' => 'success',
                'message' => ucfirst($onlyModelName) . ' deleted successfully!'
            ]);
        } catch (\Throwable $e) {
            if ($e->getCode() === '23000') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'This ' . strtolower($onlyModelName) . ' cannot be deleted because it is currently associated with other records. Please ensure all related records are removed before attempting deletion.'
                ], 409);
            }
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred while trying to delete the ' . strtolower($onlyModelName) . '.'
            ], 500);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred while trying to delete the ' . strtolower($onlyModelName) . '.'
            ], 500);
        }
    }
}
