<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuestStoreRequest;
use App\Models\Guest;
use App\Services\GuestService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class GuestsController extends Controller
{
    /**
     * @var GuestService $service
     */
    private $service;

    /**
     * GuestController constructor.
     * @param GuestService $service
     */
    public function __construct(GuestService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $guests = Guest::orderBy('created_at', 'DESC')
            ->paginate(config('database.paginator.count'));

        return view(
            'guestbook',
            [
                'guests' => $guests,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GuestStoreRequest $request
     * @return RedirectResponse
     */
    public function store(GuestStoreRequest $request): RedirectResponse
    {
        $guest = $this->service->create($request);
        if (!$guest) {
            return redirect()->route('index', $guest)->with(
                'alerts',
                ['error' => 'Не удалось создать клиента']
            );
        }
        return redirect()->route('index', $guest)->with(
            'alerts',
            ['success' => 'Клиент успешно создан']
        );
    }

}
