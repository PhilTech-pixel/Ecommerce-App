<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function view_category()
    {
        $data = Category::all();

        return view('admin.category', compact('data'));
    }

    public function add_category(Request $request)
    {

        $category = new Category;

        $category->category_name = $request->category;

        $category->save();

        toastr()->closeButton()->timeOut(5000)->addSuccess('Category Added Successfully');

        return redirect()->back();
    }


    public function delete_category($id)
    {
        $data = Category::find($id);

        $data->delete();

        toastr()->closeButton()->timeOut(5000)->addSuccess('Category Deleted Successfully');

        return redirect()->back();
    }

    public function edit_category($id)
    {
        $data = Category::find($id);
        return view('admin.edit_category', compact('data'));
    }

    public function update_category(Request $request, $id)
    {
        $data = Category::find($id);
        $data->category_name = $request->category;
        $data->save();

        toastr()->closeButton()->timeOut(5000)->addSuccess('Category Updated Successfully');

        return redirect('/view_category');
    }

    public function add_product(Request $request)
    {
        $category = Category::all();

        return view('admin.add_product', compact('category'));
    }

    public function upload_product(Request $request)
    {
        $data = new Product;

        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->quantity = $request->qty;
        $data->category = $request->category;

        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('products', $imagename);

            $data->image = $imagename;
        }

        $data->save();

        toastr()->closeButton()->timeOut(5000)->addSuccess('Product Added Successfully');

        return redirect()->back();
    }

    public function view_product()
    {
        $datas = Product::paginate(3);

        return view('admin.view_product', compact('datas'));
    }

    public function delete_product($id)
    {
        $data = Product::find($id);

        $image_path = public_path('products/' . $data->image);

        if (file_exists($image_path)) {
            unlink($image_path);
        }

        $data->delete();

        toastr()->closeButton()->timeOut(5000)->addSuccess('Category Deleted Successfully');

        return redirect()->back();
    }

    public function edit_product($id)
    {
        $data = Product::find($id);
        $category = Category::all();
        return view('admin.edit_product', compact('data', 'category'));
    }

    public function update_product(Request $request, $id)
    {
        $data = Product::find($id);
        $data->title = $request->title;
        $data->description = $request->description;
        $data->category = $request->category;
        $data->price = $request->price;
        $data->quantity = $request->quantity;

        $image = $request->image;

        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('products', $imagename);

            $data->image = $imagename;
        }
        $data->save();

        toastr()->closeButton()->timeOut(5000)->addSuccess('Product Updated Successfully');

        return redirect('/view_product');
    }

    public function product_search(Request $request)
    {

        $search = $request->search;

        $data = Product::where('title', 'LIKE', '%' . $search . '%')->orWhere('category', 'LIKE', '%' . $search . '%')->paginate(3);

        return view('admin.view_product', compact('data'));
    }

    public function view_orders()
    {
        $data = Order::all();

        return view('admin.view_orders', compact('data'));
    }

    public function on_the_way($id)
    {
        $data = Order::find($id);
        $data->status = 'On the way';
        $data->save();

        return redirect('view_orders');
    }


    public function delivered($id)
    {
        $data = Order::find($id);
        $data->status = 'Delivered';
        $data->save();

        return redirect('view_orders');
    }

    public function print_pdf($id)
    {
        $data = Order::find($id);

        $pdf = Pdf::loadView('admin.invoice', compact('data'));
        return $pdf->download('invoice.pdf');
    }
}
