Route::get('/car', [CarController::class, 'index'])->name('car.index');
Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
Route::get('/edit-user', [UserController::class, 'edit'])->name('user.edit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/car', [CarController::class, 'index'])->name('car.index');
Route::post('/car/rent', [CarController::class, 'rent'])->name('car.rent');
