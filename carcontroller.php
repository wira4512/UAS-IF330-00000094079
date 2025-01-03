namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    // Display car list
    public function index()
    {
        $cars = Car::all(); // Fetch all cars
        return view('cars', compact('cars')); // Pass data to Blade view
    }

    // Update car details
    public function update(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'make' => 'required',
            'model' => 'required',
        ]);

        // Find and update car
        $car = Car::findOrFail($request->car_id);
        $car->update([
            'make' => $request->make,
            'model' => $request->model,
        ]);

        return redirect()->route('cars.index')->with('success', 'Car updated successfully!');
    }
}
