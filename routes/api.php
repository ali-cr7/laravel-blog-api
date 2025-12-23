use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;

// Category Routes
Route::apiResource('categories', CategoryController::class);
Route::get('categories-with-posts', [CategoryController::class, 'withPosts']);

// Post Routes
Route::apiResource('posts', PostController::class);
