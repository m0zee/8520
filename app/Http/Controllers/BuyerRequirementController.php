<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BuyerRequirement;
use App\Category;
use App\SubCategory;

class BuyerRequirementController extends Controller
{
    public function index()
    {
    	$requirement = BuyerRequirement::where('status_id', '2')->with('sub_category', 'category', 'user')->get();
    	return view('frontend.requirement.index', compact('requirement'));
    }


    public function show($code)
    {
    	$requirement = BuyerRequirement::where(['code' => $code, 'status_id' => '2'])->with('sub_category', 'category', 'user')->first();
    	$related_requirement = BuyerRequirement::where(['category_id' => $requirement->category_id, 'status_id' => '2' ])->whereNotIn('id' , [$requirement->id])->with('sub_category', 'category', 'user')->get();
    	return view('frontend.requirement.show', compact('requirement', 'related_requirement'));

    }


    public function get_by_category($category_slug)
    {
    	$category = Category::where('slug', $category_slug)->first();
    	$requirement = BuyerRequirement::where(['category_id' => $category->id, 'status_id' => '2'])->with('sub_category', 'category', 'user')->get();
    	return view('frontend.requirement.index', compact('requirement'));
    }


    public function get_by_sub_category( $category_slug, $sub_category_slug)
    {
    	$sub_category = SubCategory::where('slug', $sub_category_slug)->first();
    	$requirement = BuyerRequirement::where(['sub_category_id' => $sub_category->id, 'status_id' => '2'])->with('sub_category', 'category', 'user')->get();
    	return view('frontend.requirement.index', compact('requirement'));
    }
}
