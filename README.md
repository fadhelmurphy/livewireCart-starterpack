How to run

composer install

npm install && npm run dev

php artisan serve


note for myself

composer require livewire/livewire
composer require laravel/ui
composer require darryldecode/cart
php artisan ui bootstrap --auth
npm install && npm run dev


use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

php artisan storage:link

CONFIGURATION
Open config/app.php and add this line to your Service Providers Array.
Darryldecode\Cart\CartServiceProvider::class

Open config/app.php and add this line to your Aliases
'Cart' => Darryldecode\Cart\Facades\CartFacade::class