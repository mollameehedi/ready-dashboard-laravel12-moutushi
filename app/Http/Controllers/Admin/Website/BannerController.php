<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Website\BannerCreateRequest;
use App\Models\Website\Banner;
use App\Trait\CRUD\CrudOparation;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    use CrudOparation;
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Banner::latest();
            return datatables()::of($data)
                ->addIndexColumn()
                ->addColumn('is_active', function ($row) {
                    return $row->is_active ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
                })
                ->addColumn('image', function ($row) {
                    $imageUrl = get_image_url($row, 'image'); // Use your helper function

                        return '<img src="' . $imageUrl . '" alt="'.$row->name.'" width="50">';
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->format('M d Y h:i A');
                })
                ->addColumn('action', function ($row) {
                    $deleteUrl = route('website.banner.destroy', $row->id);
                    $actionBtn = "<div class='btn-group' role='group' aria-label='Category Actions'>
                                    <a href='$deleteUrl' class='btn btn-danger btn-sm delete_btn' data-id='$row->id'><i class='fadeIn animated bx bx-trash-alt'></i></a>
                                </div>";
                    return $actionBtn;
                })
                ->rawColumns(['image', 'is_active', 'action'])
                ->make(true);
        }
        return view('admin.pages.website.banner.index');
    }

    public function create()
    {
        return view('admin.pages.website.banner.create');
    }
    public function show()
    {
        //
    }
    public function store(BannerCreateRequest $request)
    {
        $data = $request->validated();

        return $this->storeModel(Banner::class, $data);

    }
    public function destroy(string $id)
    {
        return $this->destroyModel($id,Banner::class);
    }
}
