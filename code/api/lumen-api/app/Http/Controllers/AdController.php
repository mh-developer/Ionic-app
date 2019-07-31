<?php

namespace App\Http\Controllers;

use App\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index','show']]);
    }

    /**
     * List of ads.
     *
     * @return list of all ads
     */
    public function index()
    {
        $products = Ad::all();
        // $cars = Car::where('id_uporabnika', auth()->id())->get();
        return response()->json($products);
    }

    /**
     * Create a new Ad
     *
     * @return json response with ad data
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'name'        => 'required',
            'brand'       => 'required',
            'price'       => 'required|integer',
            'description' => 'nullable',
            'tag'         => 'required'
        ]);

        $data = [
            'name'        => $request->get('name'),
            'brand'       => $request->get('brand'),
            'price'       => $request->get('price'),
            'description' => $request->get('description'),
            'tag'         => $request->get('tag'),
            'create_at'   => Carbon::now("Europe/Ljubljana")->toDateTimeString(),
            'end_at'      => Carbon::now("Europe/Ljubljana")->toDateTimeString(),
            'id_user'     => Auth::user()->id,
            'created_at'  => Carbon::now()->toDateTimeString(),
            'updated_at'  => Carbon::now()->toDateTimeString()
        ];


        $product = Ad::create($data);

        return response()->json($product);
    }

    /**
     * Show specific ad
     *
     * @param int id
     *
     * @return json response with ad data
     */
    public function show($id)
    {
        $product = Ad::find($id);

        return response()->json($product);
    }

    /**
     * Update ad attributes
     *
     * @param int id
     *
     * @return json response with ad data
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'        => 'required',
            'brand'       => 'required',
            'price'       => 'required|integer',
            'description' => 'nullable',
            'tag'         => 'required'
        ]);


        $product = Ad::find($id);

        $product->name        = $request->get('name');
        $product->brand       = $request->get('brand');
        $product->price       = $request->get('price');
        $product->description = $request->get('description');
        $product->tag         = $request->get('tag');
        $product->end_at      = Carbon::now("Europe/Ljubljana")->toDateTimeString();
        $product->updated_at  = Carbon::now()->toDateTimeString();
        $product->save();

        return response()->json($product);
    }

    /**
     * Delete specific ad
     *
     * @param int id
     *
     * @return json response with status code and message
     */
    public function destroy($id)
    {
        Schema::disableForeignKeyConstraints();
        $product = Ad::find($id);
        $product->delete();

        return response()->json([
            'message' => 'Ad removed successfully',
            'code'    => '200'
        ]);
    }
}
