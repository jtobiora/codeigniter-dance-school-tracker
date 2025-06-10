<?php

namespace App\Controllers;

use App\Models\EventModel;

class  EventController extends BaseController
{
    protected EventModel $eventModel;

    public function __construct()
    {
        $this->eventModel = new EventModel();
    }

    public function index(): string
    {
        $data['events'] = $this->eventModel->orderBy('event_date', 'DESC')->findAll();

        return view('events/index', $data);
    }

    public function create(): string
    {
        return view('events/create');
    }

    /**
     * @throws \ReflectionException
     */
    public function store(): \CodeIgniter\HTTP\RedirectResponse
    {
        $this->eventModel->save($this->request->getPost());
        return redirect()->to('/events')->with('success', 'Event created successfully.');
    }

    public function edit($id): string
    {
        $data['event'] = $this->eventModel->find($id);
        if (!$data['event']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Event with ID $id not found.");
        }
        return view('events/edit', $data);
    }

    /**
     * @throws \ReflectionException
     */
    public function update($id): \CodeIgniter\HTTP\RedirectResponse
    {
        $this->eventModel->update($id, $this->request->getPost());
        return redirect()->to('/events')->with('success', 'Event updated successfully.');
    }

    public function delete($id): \CodeIgniter\HTTP\RedirectResponse
    {
        $this->eventModel->delete($id);
        return redirect()->to('/events')->with('success', 'Event deleted successfully.');
    }

}