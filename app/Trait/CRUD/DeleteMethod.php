<?php

namespace App\Trait\CRUD;
use Spatie\MediaLibrary\InteractsWithMedia;

trait DeleteMethod
{
    public function destroyModel(string $id, string $modelName,$directory=null)
    {
        $model = $modelName;
        if($directory){
            $model = $directory.'\\'.$modelName;
        }

        $modelClass = "App\\Models\\" . $model;
        $model = $modelClass::find($id);

        if (!$model) {
            return response()->json([
                'status' => 'error',
                'message' => ucfirst($modelName) . ' not found.'
            ], 404);
        }

        try {
            if (in_array(InteractsWithMedia::class, class_uses($model)) && $model->hasMedia()) {
                $model->clearMedia();
            }
            $model->delete();
            return response()->json([
                'status' => 'success',
                'message' => ucfirst($modelName) . ' deleted successfully!'
            ]);
        } catch (\Throwable $e) {
            if ($e->getCode() === '23000') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'This ' . strtolower($modelName) . ' cannot be deleted because it is currently associated with other records. Please ensure all related records are removed before attempting deletion.'
                ], 409);
            }
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred while trying to delete the ' . strtolower($modelName) . '.'
            ], 500);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred while trying to delete the ' . strtolower($modelName) . '.'
            ], 500);
        }
    }
}
