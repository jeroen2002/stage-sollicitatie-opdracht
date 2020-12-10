<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    public function index(): JsonResponse
    {
        $todos = Todo::all();

        $response = [
            'data' => null,
            'success' => false
        ];

        if (!$todos->isEmpty()) {
            $response['data'] = $todos;
        }

        return Response::json($response, 200);
    }

    public function create(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'nullable|max:255',
            'image' => 'nullable|image'
        ]);

        if ($validator->fails()) {
            return Response::json([
                'message' => 'Er zijn fouten opgetreden',
                'data' => null,
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
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

        return Response::json([
            'message' => 'Todo is succesvol toegevoegd!',
            'data' => $todo,
            'status' => 200,
            'success' => true
        ], 200);
    }

    public function destroy(int $id): JsonResponse
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
            'message' => 'Todo is verwijderd!',
            'success' => true
        ], 200);
    }

    public function toggleTodo(int $id): JsonResponse
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
