<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Repositories\CountryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use Illuminate\Support\Facades\Storage;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class CountryController extends AppBaseController
{
    /** @var  CountryRepository */
    private $countryRepository;

    public function __construct(CountryRepository $countryRepo)
    {
        $this->countryRepository = $countryRepo;
    }

    /**
     * Display a listing of the Country.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $countries = $this->countryRepository->all();

        return view('countries.index')
            ->with('countries', $countries);
    }

    /**
     * Show the form for creating a new Country.
     *
     * @return Response
     */
    public function create()
    {
        return view('countries.create');
    }

    /**
     * Store a newly created Country in storage.
     *
     * @param CreateCountryRequest $request
     *
     * @return Response
     */
    public function store(CreateCountryRequest $request)
    {
        $input = $request->all();

        $country = $this->countryRepository->create($input);

        Flash::success('Country saved successfully.');

        return redirect(route('countries.index'));
    }

    /**
     * Display the specified Country.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $country = $this->countryRepository->find($id);

        if (empty($country)) {
            Flash::error('Country not found');

            return redirect(route('countries.index'));
        }

        return view('countries.show')->with('country', $country);
    }

    /**
     * Show the form for editing the specified Country.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $country = $this->countryRepository->find($id);

        if (empty($country)) {
            Flash::error('Country not found');

            return redirect(route('countries.index'));
        }

        return view('countries.edit')->with('country', $country);
    }

    /**
     * Update the specified Country in storage.
     *
     * @param int $id
     * @param UpdateCountryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCountryRequest $request)
    {
        $country = $this->countryRepository->find($id);

        if (empty($country)) {
            Flash::error('Country not found');

            return redirect(route('countries.index'));
        }

        $country = $this->countryRepository->update($request->all(), $id);

        Flash::success('Country updated successfully.');

        return redirect(route('countries.index'));
    }

    /**
     * Remove the specified Country from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $country = $this->countryRepository->find($id);

        if (empty($country)) {
            Flash::error('Country not found');

            return redirect(route('countries.index'));
        }

        $this->countryRepository->delete($id);

        Flash::success('Country deleted successfully.');

        return redirect(route('countries.index'));
    }

    public function readcsv()
    {
        // ini_set('max_execution_time', 30000);
        $file_n = storage_path('app/worldcities.csv');
        $file = fopen($file_n, "r");
        $all_data = array();

        fgetcsv($file);

        $i = 0;
        // echo'<pre>';
        while ( ($data = fgetcsv($file, 200, ",")) !== FALSE ) {
            if (isset($data[1]) && isset($data[5]) && isset($data[6]) && isset($data[7]) && isset($data[9]) && isset($data[10])) {
                // echo $i . ' | Country:- ' .$data[5]. ' == State:- ' .$data[9]. ' == City:- ' .$data[1].'<br>';
                isset($data[5]) ? $country = Country::where('name', 'like', trim($data[5]))->first() : $country = null;
                isset($data[9]) ? $state = State::where('name', 'like', trim($data[9]))->first() : $state = null;
                isset($data[1]) ? $city = City::where('name', 'like', trim($data[1]))->first() : $city = null;

                // var_dump($country);
                // var_dump($state);
                // var_dump($city);
                // exit;
                if ($country == null) {
                    $country = Country::create([
                        'name' => trim($data[5]),
                        'code' => trim($data[7]),
                        'short_code' => trim($data[6])
                    ]);
                }

                if ($state == null) {
                    $state = State::create([
                        'name' => trim($data[9]),
                        'short_code' => trim($data[10]),
                        'country_id' => $country->id
                    ]);
                }

                if ($city == null) {
                    $city = City::create([
                        'name' => trim($data[1]),
                        'state_id' => $state->id,
                        'country_id' => $country->id
                    ]);
                }
                $i++;
            }
        }
        fclose($file);
// exit;
        Flash::success($i . ' records added successfully.');

        return redirect(route('countries.index'));
    }
}
