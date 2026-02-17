<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ContactMessageController extends Controller
{
    public function index()
    {
        $data = ContactMessage::latest()->get();
        if (request()->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = ('<div class="btn-group" role="group" aria-label="First group">
                   <a href="' . route('admin.contact.message.show', $row->id) . '" class="text-white btn btn-primary"><i class="fadeIn animated bx bx-show"></i></a>
                    <a href="' . route('admin.contact.message.destroy', $row->id) . '"  data-id="'.$row->id.'" title="Delete" href="'.route("admin.contact.message.destroy",$row->id).'"" class=" delete_btn text-white btn btn-danger"><i class="fadeIn animated bx bx-trash"></i></a>
                </div>');
                    return $actionBtn;
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->format('d M Y');
                })
                ->rawColumns(['action','created_at'])
                ->make(true);
        }
        return view('admin.pages.contact.message.index');
    }

    public function show(string $id)
    {
        $contact = ContactMessage::find($id);
        return view('admin.pages.contact.message.show',compact('contact'));
    }
}
