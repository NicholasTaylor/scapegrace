sudo kill -9 $(sudo lsof -t -i:5173,8000)
php artisan serve & npm run dev && fg