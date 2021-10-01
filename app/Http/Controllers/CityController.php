<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Repositories\CityRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\City;
use Flash;
use Response;

use DB;

class CityController extends AppBaseController
{
    /** @var  CityRepository */
    private $cityRepository;

    public function __construct(CityRepository $cityRepo)
    {
        $this->cityRepository = $cityRepo;
    }

    /**
     * Display a listing of the City.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $cities = City::paginate(10);

        return view('cities.index')
            ->with('cities', $cities);
    }

    /**
     * Show the form for creating a new City.
     *
     * @return Response
     */
    public function create()
    {
        $countries = DB::table('countries')->whereNull('deleted_at')->pluck('name', 'id')->toArray();
        $countries[0] = 'Select Country';
        ksort($countries);

        $states = DB::table('states')->whereNull('deleted_at')->pluck('name', 'id')->toArray();
        $states[0] = 'Select State';
        ksort($states);

        return view('cities.create')->with('states', $states)->with('countries', $countries);
    }

    /**
     * Store a newly created City in storage.
     *
     * @param CreateCityRequest $request
     *
     * @return Response
     */
    public function store(CreateCityRequest $request)
    {
        $input = $request->all();

        $city = $this->cityRepository->create($input);

        Flash::success('City saved successfully.');

        return redirect(route('cities.index'));
    }

    /**
     * Display the specified City.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $city = $this->cityRepository->find($id);

        if (empty($city)) {
            Flash::error('City not found');

            return redirect(route('cities.index'));
        }

        return view('cities.show')->with('city', $city);
    }

    /**
     * Show the form for editing the specified City.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $city = $this->cityRepository->find($id);

        $countries = DB::table('countries')->whereNull('deleted_at')->pluck('name', 'id')->toArray();
        $countries[0] = 'Select Country';
        ksort($countries);

        $states = DB::table('states')->whereNull('deleted_at')->pluck('name', 'id')->toArray();
        $states[0] = 'Select State';
        ksort($states);

        if (empty($city)) {
            Flash::error('City not found');

            return redirect(route('cities.index'));
        }

        return view('cities.edit')->with('city', $city)->with('states', $states)->with('countries', $countries);
    }

    /**
     * Update the specified City in storage.
     *
     * @param int $id
     * @param UpdateCityRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCityRequest $request)
    {
        $city = $this->cityRepository->find($id);

        if (empty($city)) {
            Flash::error('City not found');

            return redirect(route('cities.index'));
        }

        $city = $this->cityRepository->update($request->all(), $id);

        Flash::success('City updated successfully.');

        return redirect(route('cities.index'));
    }

    /**
     * Remove the specified City from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $city = $this->cityRepository->find($id);

        if (empty($city)) {
            Flash::error('City not found');

            return redirect(route('cities.index'));
        }

        $this->cityRepository->delete($id);

        Flash::success('City deleted successfully.');

        return redirect(route('cities.index'));
    }

    // Fetch records
    public function getCities(Request $request){
        $state_id = $request->state_id;

        $cities = DB::table('cities')->whereNull('deleted_at')->orderby('name','asc')->select('id','name')->where('state_id', $state_id)->get();

        $response = array();
        foreach($cities as $city){
            $response[] = array(
                "id" => $city->id,
                "text" => $city->name
            );
        }
        return response()->json($response); 
    }
}
