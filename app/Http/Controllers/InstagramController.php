<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class InstagramController extends Controller
{
    public function index(Request $request)
	{
		if ($request->ajax()) {
			try {
				$url = env('SERVICE_INSTAGRAM') . '/instagram';
				// // Caching data selama 120 menit (2 jam)
				$feeds = Cache::remember('instagram_feeds', 120, function () use ($url) {
					$response = Http::withHeaders([
						'Accept' => 'application/json',
						'_token' => null,
					])->get($url);
					return json_decode($response->body(), true)['data'];
				});

				$feeds = array_slice($feeds, 0, 4);
			} catch (\Throwable $th) {
				return $this->error($th->getMessage());
			}

			return view('media.instagram.index', ['feeds' => $feeds]);
		}
	}

	public function show(Request $request, $id)
	{
		if ($request->ajax()) {
			try {
				$url = env('SERVICE_INSTAGRAM') . "/instagram/{$id}";
				$fields = "?fields=id,caption,media_type,media_url,permalink,username";

				$response = Http::withHeaders([
					'Accept' => 'application/json',
					'_token' => null,
				])->get($url . $fields);

				if ($response->successful()) {

					$responseData = json_decode($response->body(), true);
					// Pastikan key `data` ada
					$media = $responseData['data'] ?? [];

					return view('media.instagram.show', ['media' => $media]);
				} else {
					throw new \Exception('API request failed.');
				}
			} catch (\Throwable $th) {
				return $this->error($th->getMessage());
			}
		}
	}
}
