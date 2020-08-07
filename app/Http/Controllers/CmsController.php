<?php

namespace App\Http\Controllers;

use App\Cms_page;
use DemeterChain\C;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    public function addCmsPage(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $data = $request->all();
//            echo '<pre>'; print_r($data); die;
            $cmspage = new Cms_page;
            $cmspage->title = $data['title'];
            $cmspage->url = $data['url'];
            $cmspage->description = $data['description'];

            $status = empty($data['status']) ? 0  : 1 ;
            $subtitle = empty($data['sub_title']) ? null  : $data['sub_title'] ;

            $cmspage->status = $status;
            $cmspage->sub_title = $subtitle;
            $cmspage->save();
            $notification = array(
                'message' => 'CMS Page has been added successfully!!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);

        }
        return view('admin.pages.add_cms_page');
    }

    public function viewCmsPage()
    {
        $cmsPages = Cms_page::all();
        return view('admin.pages.view_cms_page', compact('cmsPages'));
    }

    public function updateCmsPage(Request $request, $id)
    {
        $cmsPage = Cms_page::where('id', $id)->first();
//        $cmsPage = json_decode(json_encode($cmsPage));
//        echo '<pre>'; print_r($cmsPage); die();
        if ($request->isMethod('Post')){
            $data = $request->all();

            $status = empty($data['status']) ? 0  : 1 ;

            $cms_edit = Cms_page::where('id', $id)->first();
            $cms_edit->title = $data['title'];
            $cms_edit->sub_title = $data['sub_title'];
            $cms_edit->url = $data['url'];
            $cms_edit->description = $data['description'];
            $cms_edit->status = $status;
            $cms_edit->save();

            $notification = array(
                'message' => 'CMS Page has been Updated successfully!!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }

        return view('admin.pages.edit_cms_page', compact('cmsPage'));
    }

    public function cmsPage($url)
    {
        $cmsPageDetails = Cms_page::where('url', $url)->first();
        return view('pages.cms_page', compact('cmsPageDetails'));
    }
}
