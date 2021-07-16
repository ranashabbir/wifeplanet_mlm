<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMessagesRequest;
use App\Http\Requests\UpdateMessagesRequest;
use App\Repositories\MessagesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use Image;
use Illuminate\Support\Facades\Storage;

class MessagesController extends AppBaseController
{
    /** @var  MessagesRepository */
    private $messagesRepository;

    public function __construct(MessagesRepository $messagesRepo)
    {
        $this->messagesRepository = $messagesRepo;
    }

    /**
     * Display a listing of the Messages.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $messagess = $this->messagesRepository->paginate(10);

        return view('messagess.index')
            ->with('messagess', $messagess);
    }

    /**
     * Show the form for creating a new Messages.
     *
     * @return Response
     */
    public function create()
    {
        return view('messagess.create');
    }

    /**
     * Store a newly created Messages in storage.
     *
     * @param CreateMessagesRequest $request
     *
     * @return Response
     */
    public function store(CreateMessagesRequest $request)
    {
        $input = $request->all();

        $messages = $this->messagesRepository->create($input);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $file_name = explode('.',$image->getClientOriginalName());
            $file_name = $file_name[0].'_'.time().rand(4,9999);
            $file_type = $image->getClientOriginalExtension();
            $file_title = $image->getClientOriginalName();

            $img = Image::make($image->getRealPath());
            $img->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();                 
            });

            $img->stream(); // <-- Key point

            $fileName = $file_name.'.'.$file_type;
            Storage::disk('local')->put('public/messagess/' . $messages->id . '/'.  $fileName, $img, 'public');

			$messages->image = $file_name.'.'.$file_type;
            $messages->save();
        }

        Flash::success('Messages saved successfully.');

        return redirect(route('messagess.index'));
    }

    /**
     * Display the specified Messages.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $messages = $this->messagesRepository->find($id);

        if (empty($messages)) {
            Flash::error('Messages not found');

            return redirect(route('messagess.index'));
        }

        return view('messagess.show')->with('messages', $messages);
    }

    /**
     * Show the form for editing the specified Messages.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $messages = $this->messagesRepository->find($id);

        if (empty($messages)) {
            Flash::error('Messages not found');

            return redirect(route('messagess.index'));
        }

        return view('messagess.edit')->with('messages', $messages);
    }

    /**
     * Update the specified Messages in storage.
     *
     * @param int $id
     * @param UpdateMessagesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMessagesRequest $request)
    {
        $messages = $this->messagesRepository->find($id);

        if (empty($messages)) {
            Flash::error('Messages not found');

            return redirect(route('messagess.index'));
        }

        $messages = $this->messagesRepository->update($request->all(), $id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $file_name = explode('.',$image->getClientOriginalName());
            $file_name = $file_name[0].'_'.time().rand(4,9999);
            $file_type = $image->getClientOriginalExtension();
            $file_title = $image->getClientOriginalName();

            // $request->file('image')->storeAs('public/messagess/' . $messages->id, $file_name.'.'.$file_type);

            $img = Image::make($image->getRealPath());
            $img->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();                 
            });

            $img->stream(); // <-- Key point

            $fileName = $file_name.'.'.$file_type;
            Storage::disk('local')->put('public/messagess/' . $messages->id . '/'.  $fileName, $img, 'public');

			$messages->image = $fileName;
            $messages->save();
        }

        Flash::success('Messages updated successfully.');

        return redirect(route('messagess.index'));
    }

    /**
     * Remove the specified Messages from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $messages = $this->messagesRepository->find($id);

        if (empty($messages)) {
            Flash::error('Messages not found');

            return redirect(route('messagess.index'));
        }

        $this->messagesRepository->delete($id);

        Flash::success('Messages deleted successfully.');

        return redirect(route('messagess.index'));
    }
}
