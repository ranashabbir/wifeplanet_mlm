<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStateRequest;
use App\Http\Requests\UpdateStateRequest;
use App\Repositories\StateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\State;
use Flash;
use Response;

use DB;

class StateController extends AppBaseController
{
    /** @var  StateRepository */
    private $stateRepository;

    public function __construct(StateRepository $stateRepo)
    {
        $this->stateRepository = $stateRepo;
    }

    /**
     * Display a listing of the State.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $states = State::paginate(10);

        return view('states.index')
            ->with('states', $states);
    }

    /**
     * Show the form for creating a new State.
     *
     * @return Response
     */
    public function create()
    {
        $countries = DB::table('countries')->whereNull('deleted_at')->pluck('name', 'id')->toArray();
        $countries[0] = 'Select Country';
        ksort($countries);

        return view('states.create')
            ->with('countries', $countries);
    }

    /**
     * Store a newly created State in storage.
     *
     * @param CreateStateRequest $request
     *
     * @return Response
     */
    public function store(CreateStateRequest $request)
    {
        $input = $request->all();

        $state = $this->stateRepository->create($input);

        Flash::success('State saved successfully.');

        return redirect(route('states.index'));
    }

    /**
     * Display the specified State.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $state = $this->stateRepository->find($id);

        if (empty($state)) {
            Flash::error('State not found');

            return redirect(route('states.index'));
        }

        return view('states.show')->with('state', $state);
    }

    /**
     * Show the form for editing the specified State.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $state = $this->stateRepository->find($id);
        $countries = DB::table('countries')->whereNull('deleted_at')->pluck('name', 'id')->toArray();
        $countries[0] = 'Select Country';
        ksort($countries);

        if (empty($state)) {
            Flash::error('State not found');

            return redirect(route('states.index'));
        }

        return view('states.edit')->with('state', $state)->with('countries', $countries);
    }

    /**
     * Update the specified State in storage.
     *
     * @param int $id
     * @param UpdateStateRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStateRequest $request)
    {
        $state = $this->stateRepository->find($id);

        if (empty($state)) {
            Flash::error('State not found');

            return redirect(route('states.index'));
        }

        $state = $this->stateRepository->update($request->all(), $id);

        Flash::success('State updated successfully.');

        return redirect(route('states.index'));
    }

    /**
     * Remove the specified State from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $state = $this->stateRepository->find($id);

        if (empty($state)) {
            Flash::error('State not found');

            return redirect(route('states.index'));
        }

        $this->stateRepository->delete($id);

        Flash::success('State deleted successfully.');

        return redirect(route('states.index'));
    }

    // Fetch records
    public function getStates(Request $request){
        $country_id = $request->country_id;

        $states = DB::table('states')->whereNull('deleted_at')->orderby('name','asc')->select('id','name')->where('country_id', $country_id)->get();

        $response = array();
        foreach($states as $state){
            $response[] = array(
                "id" => $state->id,
                "text" => $state->name
            );
        }
        return response()->json($response); 
    }
}
