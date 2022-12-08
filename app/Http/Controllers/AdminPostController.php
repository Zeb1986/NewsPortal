<?php

namespace App\Http\Controllers;

use App\Mail\DemoMail;
use App\Models\Post;
use App\Models\Subscriber;
use Illuminate\Validation\Rule;
use Mail;

class AdminPostController extends Controller
{
    public function index() {
        return view('admin.posts.index', [
            'posts' => Post::paginate(50)
        ]);
    }

    public function create() {

        return view('admin.posts.create');
    }

    public function store() {
        $attributes = $this->validatePost();

        $attributes['user_id'] = auth()->id();
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');

        Post::create($attributes);


        $mailData = [
            'title' => $attributes['title'],
            'body' => $attributes['excerpt'],
            'slug' => $attributes['slug']
        ];

        $emails = Subscriber::pluck('email');

        Mail::to($emails)->send(new DemoMail($mailData));

        return redirect('/');
    }
    public function edit(Post $post) {
        return view('admin.posts.edit', ['post' => $post]);
    }

    public function update(Post $post) {
        $attributes = $this->validatePost($post);
        if(isset($attributes['thumbnail'])) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }
        $post->update($attributes);

        return back()->with('success', 'Post updated!');
    }

    public function destroy(Post $post) {
        $post->delete();
        return back()->with('success', 'Post deleted!');
    }

    /**
     * @param Post $post
     * @return array
     */
    protected function validatePost(?Post $post = null): array
    {
        $post??= new Post();
        return request()->validate([
            'title' => 'required',
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'thumbnail' => $post->exists() ? ['image'] : ['required', 'image'],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
//            'published_at' => 'required'
        ]);
    }
}
