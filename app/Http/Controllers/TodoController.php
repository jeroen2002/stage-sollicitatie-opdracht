<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    /**
     * @return array
     */
    public function index()
    {
        $todos = Todo::all();

        $response = [
            'data' => null,
            'status' => 200,
            'success' => false
        ];

        if (!$todos->isEmpty()) {
            $response['data'] = $todos;
        }

        return $response;
    }

    /**
     * @param Request $request
     * @return false|string
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image'
        ]);

        if ($validator->fails()) {
            return json_encode([
                'message' => 'Er zijn fouten opgetreden',
                'data' => null,
                'status' => 400,
                'success' => false,
                'errors' => $validator->errors(),
            ]);
        }

        $store = '';
        if (!empty($request->file('image'))) {
            $image = $request->file('image');
            $store = Storage::disk('public')->put('images', $image);
        }

        $todo = Todo::create([
            'title' => $request->get('title'),
            'description' => $request->get('description') ?? '',
            'image_name' => basename($store) ?? ''
        ]);

        $response = [
            'message' => 'Todo is succesvol toegevoegd!',
            'data' => $todo,
            'status' => 200,
            'success' => true
        ];

        return json_encode($response);
    }

    /**
     * @param int $id
     * @return false|\Illuminate\Http\JsonResponse|string
     */
    public function destroy(int $id)
    {
        $todo = Todo::find($id);

        if (!$todo) {
            return Response::json([
                'message' => 'Verwijderen mislukt, probeer het later opnieuw.',
                'success' => false
            ], 404);
        }

        $todo->delete();

        return Response::json([
            'message' => 'Verwijderen gelukt!',
            'success' => true
        ], 200);
    }

    /**
     * @param int $id
     */
    public function toggleTodo(int $id)
    {
        $todo = Todo::find($id);

        if (!$todo) {
            return Response::json([
                'message' => 'Er is wat misgegaan, probeer het later opnieuw',
                'success' => false
            ], 404);
        }

        $todo->is_done = !$todo->is_done;
        $todo->save();

        return Response::json([
            'message' => null,
            'success' => true
        ], 200);
    }
}
