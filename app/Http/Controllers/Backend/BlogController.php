<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\MultiImagePost;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    public function AllBlogCategory()
    {

        $category = BlogCategory::latest()->get();
        return view('backend.category.blog_category', compact('category'));

    } // End Method

    public function StoreBlogCategory(Request $request)
    {

        BlogCategory::insert([

            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
        ]);

        $notification = array(
            'message' => 'BlogCategory Create Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.blog.category')->with($notification);

    } // End Method

    public function EditBlogCategory($id)
    {

        $categories = BlogCategory::findOrFail($id);
        return response()->json($categories);

    } // End Method

    public function UpdateBlogCategory(Request $request)
    {

        $cat_id = $request->cat_id;

        BlogCategory::findOrFail($cat_id)->update([

            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
        ]);

        $notification = array(
            'message' => 'BlogCategory Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.blog.category')->with($notification);

    } // End Method

    public function DeleteBlogCategory($id)
    {

        BlogCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'BlogCategory Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    } // End Method

    public function AllPost()
    {

        $post = BlogPost::latest()->get();
        return view('backend.post.all_post', compact('post'));

    } // End Method

    public function AddPost()
    {

        $blogcat = BlogCategory::latest()->get();
        return view('backend.post.add_post', compact('blogcat'));

    } // End Method

    public function StorePost(Request $request)
    {

        $image = $request->file('post_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 250)->save('upload/post/' . $name_gen);
        $save_url = 'upload/post/' . $name_gen;

        $post_id = BlogPost::insertGetId([
            'blogcat_id' => $request->blogcat_id,
            'user_id' => Auth::user()->id,
            'post_title' => $request->post_title,
            'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'post_tags' => $request->post_tags,
            'post_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        /// Multiple Image Upload From Here ////

        $images = $request->file('multi_images');
        foreach ($images as $img) {

            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(770, 520)->save('upload/post/multi-image-post/' . $make_name);
            $uploadPath = 'upload/post/multi-image-post/' . $make_name;

            MultiImagePost::insert([

                'post_id' => $post_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),

            ]);
        } // End Foreach

        $notification = array(
            'message' => 'BlogPost Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.post')->with($notification);

    } // End Method

    public function EditPost($id)
    {

        $blogcat = BlogCategory::latest()->get();
        $post = BlogPost::findOrFail($id);
        $multiImage = MultiImagePost::where('post_id', $id)->get();
        return view('backend.post.edit_post', compact('post', 'blogcat', 'multiImage'));

    } // End Method

    public function UpdatePost(Request $request)
    {

        $post_id = $request->id;

        if ($request->file('post_image')) {

            $image = $request->file('post_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(370, 250)->save('upload/post/' . $name_gen);
            $save_url = 'upload/post/' . $name_gen;

            BlogPost::findOrFail($post_id)->update([
                'blogcat_id' => $request->blogcat_id,
                'user_id' => Auth::user()->id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'short_descp' => $request->short_descp,
                'long_descp' => $request->long_descp,
                'post_tags' => $request->post_tags,
                'post_image' => $save_url,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'BlogPost Updated Successfully',
                'alert-type' => 'success',
            );

            return redirect()->route('all.post')->with($notification);

        } else {

            BlogPost::findOrFail($post_id)->update([
                'blogcat_id' => $request->blogcat_id,
                'user_id' => Auth::user()->id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'short_descp' => $request->short_descp,
                'long_descp' => $request->long_descp,
                'post_tags' => $request->post_tags,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'BlogPost Updated Successfully',
                'alert-type' => 'success',
            );

            return redirect()->route('all.post')->with($notification);

        } // end else

    } // End Method

    public function DeletePostMulti($id)
    {

        $old_image = MultiImagePost::findOrFail($id);
        unlink($old_image->photo_name);

        MultiImagePost::findOrFail($id)->delete();

        $notif = array(
            'message' => 'Post Multiple Image Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notif);

    } // End Method

    public function DeletePost($id)
    {

        $post = BlogPost::findOrFail($id);
        $img = $post->post_image;
        unlink($img);

        BlogPost::findOrFail($id)->delete();

        $multi_image = MultiImagePost::where('post_id', $id)->get();

        foreach ($multi_image as $image) {

            unlink($image->photo_name);
            MultiImagePost::where('post_id', $id)->delete();
        }

        $notification = array(
            'message' => 'BlogPost Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);

    } // End Method

    public function UpdatePostMultiImage(Request $request)
    {

        $images = $request->multi_image;

        foreach ($images as $id => $img) {
            $imgDelete = MultiImagePost::findOrFail($id);
            unlink($imgDelete->photo_name);

            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(770, 520)->save('upload/post/multi-image-post/' . $make_name);
            $uploadPath = 'upload/post/multi-image-post/' . $make_name;

            MultiImagePost::where('id', $id)->update([

                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now(),

            ]);

        } // End Foreach

        $notif = array(
            'message' => 'Property Multiple Image Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notif);
    } // End Method

    public function StoreNewMultiImagePost(Request $request)
    {

        $new_multi = $request->imageId;
        $image = $request->file('multi_image');

        $make_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(770, 520)->save('upload/post/multi-image-post/' . $make_name);
        $uploadPath = 'upload/post/multi-image-post/' . $make_name;

        MultiImagePost::insert([

            'post_id' => $new_multi,
            'photo_name' => $uploadPath,
            'created_at' => Carbon::now(),

        ]);

        $notif = array(
            'message' => 'Post Multiple Image Added Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notif);

    } // End StoreNewMultiImage

    public function BlogDetails($id, $slug)
    {

        $blog = BlogPost::where('post_slug', $slug)->first();

        $tags = $blog->post_tags;
        $tags_all = explode(',', $tags);

        $bcategory = BlogCategory::latest()->get();
        $dpost = BlogPost::latest()->limit(3)->get();
        $multiImage = MultiImagePost::where('post_id', $id)->get();

        return view('frontend.blog.blog_details', compact('blog', 'tags_all', 'bcategory', 'dpost', 'multiImage'));

    } // End Method

    public function BlogCatList($id)
    {

        $blog = BlogPost::where('blogcat_id', $id)->get();
        $breadcat = BlogCategory::where('id', $id)->first();
        $bcategory = BlogCategory::latest()->get();
        $dpost = BlogPost::latest()->limit(3)->get();

        return view('frontend.blog.blog_cat_list', compact('blog', 'breadcat', 'bcategory', 'dpost'));

    } // End Method

    public function BlogList()
    {

        $blog = BlogPost::latest()->get();
        $bcategory = BlogCategory::latest()->get();
        $dpost = BlogPost::latest()->limit(3)->get();

        return view('frontend.blog.blog_list', compact('blog', 'bcategory', 'dpost'));

    } // End Method

    public function StoreComment(Request $request)
    {

        $pid = $request->post_id;

        Comment::insert([
            'user_id' => Auth::user()->id,
            'post_id' => $pid,
            'parent_id' => null,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Comment Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);

    } // End Method

    public function AdminBlogComment()
    {

        $comment = Comment::where('parent_id', null)->latest()->get();
        return view('backend.comment.comment_all', compact('comment'));

    } // End Method

    public function AdminCommentReply($id)
    {

        $comment = Comment::where('id', $id)->first();
        return view('backend.comment.reply_comment', compact('comment'));

    } // End Method

    public function ReplyMessage(Request $request)
    {

        $id = $request->id;
        $user_id = $request->user_id;
        $post_id = $request->post_id;

        Comment::insert([
            'user_id' => $user_id,
            'post_id' => $post_id,
            'parent_id' => $id,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Reply Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);

    } // End Method

}
