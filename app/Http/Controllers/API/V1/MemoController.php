<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Memo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class MemoController extends Controller
{
    /**
     * メモ作成API
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'folder_id' => 'nullable|integer',
            'title' => 'required|string',
            'contents' => 'required',
            'is_public' => 'nullable|boolean',
        ]);

        $memo = new Memo();
        $memo->id = Str::uuid();
        $memo->user_id = $request->user() ? $request->user()->id : null;
        $memo->folder_id = $request->get('folder_id', null);
        $memo->title = $request->get('title');
        $memo->contents = $request->get('contents');
        $memo->is_public = $request->get('is_public', false);

        $memo->save();

        return response()->json([
            'key' => Crypt::encryptString($memo->id),
        ]);
    }
}
