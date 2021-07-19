<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMessagesRequest;
use App\Http\Requests\UpdateMessagesRequest;
use App\Repositories\MessagesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\Conversation;
use Image;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Repositories\ChatRepository;

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
        $messages = Conversation::whereNull('reply_to')->where('to_id', \Auth::user()->id)->paginate(10);

        return view('messages.index')
            ->with('messages', $messages);
    }

    public function outbox(Request $request)
    {
        $messages = Conversation::where('from_id', \Auth::user()->id)->paginate(10);

        return view('messages.outbox')
            ->with('messages', $messages);
    }

    /**
     * Display message Detail
     * 
     * @param Request $request
    */
    public function view($id) {
        $message = Conversation::where('id', $id)->first();

        return view('messages.view')
            ->with('message', $message);
    }

    /**
     * Show the form for creating a new Messages.
     *
     * @return Response
     */
    public function compose()
    {
        $users = DB::table('users')->whereNull('deleted_at')->pluck('name', 'id')->toArray();
        $users[0] = 'Select User';
        ksort($users);

        return view('messages.compose')
                ->with('users', $users);
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

        $replyMessage = new Conversation();
        $replyMessage->to_id = $request->input('to_id');
        $replyMessage->message = $request->input('message');
        $replyMessage->from_id = \Auth::user()->id;
        $replyMessage->save();

        if ($request->hasFile('file')) {
            // $image = $request->file('file');
            // $file_name = explode('.',$image->getClientOriginalName());
            // $file_name = $file_name[0].'_'.time().rand(4,9999);
            // $file_type = $image->getClientOriginalExtension();
            // $file_title = $image->getClientOriginalName();

            // $img = Image::make($image->getRealPath());
            // $img->resize(400, 400, function ($constraint) {
            //     $constraint->aspectRatio();                 
            // });

            // $img->stream(); // <-- Key point

            // $fileName = $file_name.'.'.$file_type;
            // Storage::disk('local')->put('public/messages/' . $messages->id . '/'.  $fileName, $img, 'public');

			// $messages->image = $file_name.'.'.$file_type;
            // $messages->save();
        }

        Flash::success('Messages saved successfully.');

        return redirect(route('messages.inbox'));
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

            return redirect(route('messages.inbox'));
        }

        return view('messages.show')->with('messages', $messages);
    }

    public function reply($id)
    {
        $message = Conversation::where('id', $id)->first();
        $users = DB::table('users')->whereNull('deleted_at')->pluck('name', 'id')->toArray();
        $users[0] = 'Select User';
        ksort($users);

        if (empty($message)) {
            Flash::error('Messages not found');

            return redirect(route('messages.inbox'));
        }

        return view('messages.compose')
                    ->with('message', $message)
                    ->with('users', $users)
                    ->with('id', $id);
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

            return redirect(route('messages.inbox'));
        }

        return view('messages.edit')->with('messages', $messages);
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
        $message = Conversation::where('id', $id)->first();

        if (empty($message)) {
            Flash::error('Messages not found');

            return redirect(route('messages.inbox'));
        }
        $replyMessage = new Conversation();
        $replyMessage->to_id = $request->input('to_id');
        $replyMessage->message = $request->input('message');
        $replyMessage->from_id = \Auth::user()->id;
        $replyMessage->save();

        if ($request->hasFile('file')) {
            // $file = $request->file('file');
            // $extension = strtolower($file->getClientOriginalExtension());
            // if (! in_array($extension,
            //     [
            //         'xls', 'pdf', 'doc', 'docx', 'xlsx', 'jpg', 'gif', 'jpeg', 'png', 'mp4', 'mkv', 'avi', 'txt', 'mp3',
            //         'ogg', 'wav', 'aac', 'alac',
            //         'zip', 'rar',
            //     ])) {
            //     throw new ApiOperationFailedException('You can not upload this file.', Response::HTTP_BAD_REQUEST);
            // }

            // if (in_array($extension, ['jpg', 'gif', 'png', 'jpeg'])) {
            //     $fileName = ImageTrait::makeImage($file, Conversation::PATH, []);
            // }

            // if (in_array($extension, ['xls', 'pdf', 'doc', 'docx', 'xlsx', 'txt'])) {
            //     $fileName = ImageTrait::makeAttachment($file, Conversation::PATH);
            // }

            // if (in_array($extension, ['mp4', 'mkv', 'avi'])) {
            //     $fileName = ImageTrait::uploadVideo($file, Conversation::PATH);
            // }

            // if (in_array($extension, ['mp3', 'ogg', 'wav', 'aac', 'alac', 'zip', 'rar'])) {
            //     $fileName = ImageTrait::uploadFile($file, Conversation::PATH);
            // }

			// $replyMessage->file_name = $fileName;
            // $replyMessage->save();
        }

        Flash::success('Messages updated successfully.');

        return redirect(route('messages.inbox'));
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

            return redirect(route('messages.inbox'));
        }

        $this->messagesRepository->delete($id);

        Flash::success('Messages deleted successfully.');

        return redirect(route('messages.inbox'));
    }
}
