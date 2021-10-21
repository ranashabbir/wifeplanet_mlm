<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePlanRequest;
use App\Http\Requests\UpdatePlanRequest;
use App\Repositories\PlanRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Flash;
use Response;
use DB;
use Image;
use Illuminate\Support\Facades\Storage;
use App\Models\Plan;
use App\Models\Bonus;
use App\Models\Subscription;
use Auth;
use App\Models\Commission;
use App\Models\User;
use App\Models\Transaction;

class PlanController extends AppBaseController
{
    /** @var  PlanRepository */
    private $planRepository;

    public function __construct(PlanRepository $planRepo)
    {
        $this->planRepository = $planRepo;
    }

    /**
     * Display a listing of the Plan.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $plans = DB::table('plans')->select('plans.*', 'roles.name')
                        ->leftJoin('roles', 'plans.role_id', '=', 'roles.id')
                        ->whereNull('plans.deleted_at')
                        ->paginate(10);

        return view('plans.index')
            ->with('plans', $plans);
    }

    public function mlmPackages()
    {
        $plans = Plan::where('site', 'mlm')->whereNull('deleted_at')->get();
        $subscription = Auth::user()->subscriptions->last();

        return view('plans.mlmpackages')
            ->with('plans', $plans)
            ->with('subscription', $subscription);
    }

    /**
     * Show the form for creating a new Plan.
     *
     * @return Response
     */
    public function create()
    {
        $roles = DB::table('roles')->whereNull('deleted_at')->pluck('name', 'id')->toArray();
        $roles[0] = 'Select User Group';
        ksort($roles);

        return view('plans.create')->with('roles', $roles);
    }

    /**
     * Store a newly created Plan in storage.
     *
     * @param CreatePlanRequest $request
     *
     * @return Response
     */
    public function store(CreatePlanRequest $request)
    {
        $input = $request->all();

        $plan = $this->planRepository->create($input);

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
            Storage::disk('local')->put('public/plans/' . $plan->id . '/'.  $fileName, $img, 'public');

			$plan->image = $file_name.'.'.$file_type;
            $plan->save();
        }

        Flash::success('Plan saved successfully.');

        if ($request->input('site') == 'mlm') {
            return redirect(route('plans.bonus', $plan->id));
        } else {
            return redirect(route('plans.index'));
        }
    }

    /**
     * Display the specified Plan.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $plan = $this->planRepository->find($id);

        if (empty($plan)) {
            Flash::error('Plan not found');

            return redirect(route('plans.index'));
        }

        return view('plans.show')->with('plan', $plan);
    }

    /**
     * Show the form for editing the specified Plan.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $plan = $this->planRepository->find($id);

        $roles = DB::table('roles')->whereNull('deleted_at')->pluck('name', 'id')->toArray();
        $roles[0] = 'Select User Group';
        ksort($roles);

        if (empty($plan)) {
            Flash::error('Plan not found');

            return redirect(route('plans.index'));
        }

        return view('plans.edit')->with('plan', $plan)->with('roles', $roles);
    }

    /**
     * Update the specified Plan in storage.
     *
     * @param int $id
     * @param UpdatePlanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePlanRequest $request)
    {
        $plan = $this->planRepository->find($id);

        if (empty($plan)) {
            Flash::error('Plan not found');

            return redirect(route('plans.index'));
        }

        $plan = $this->planRepository->update($request->all(), $id);

        if ($request->input('site') == 'mlm') {
            $plan->type = '';
            $plan->save();
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $file_name = explode('.',$image->getClientOriginalName());
            $file_name = $file_name[0].'_'.time().rand(4,9999);
            $file_type = $image->getClientOriginalExtension();
            $file_title = $image->getClientOriginalName();

            // $request->file('image')->storeAs('public/plans/' . $plan->id, $file_name.'.'.$file_type);

            $img = Image::make($image->getRealPath());
            $img->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();                 
            });

            $img->stream(); // <-- Key point

            $fileName = $file_name.'.'.$file_type;
            Storage::disk('local')->put('public/plans/' . $plan->id . '/'.  $fileName, $img, 'public');

			$plan->image = $fileName;
            $plan->save();
        }

        Flash::success('Plan updated successfully.');

        if ($request->input('site') == 'mlm') {
            return redirect(route('plans.bonus', $plan->id));
        } else {
            return redirect(route('plans.index'));
        }
    }

    /**
     * Remove the specified Plan from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $plan = $this->planRepository->find($id);

        if (empty($plan)) {
            Flash::error('Plan not found');

            return redirect(route('plans.index'));
        }

        $this->planRepository->delete($id);

        Flash::success('Plan deleted successfully.');

        return redirect(route('plans.index'));
    }

    public function bonus($id) {
        $plan = Plan::where('id', $id)->first();

        return view('plans.bonus')->with('plan', $plan);
    }

    public function createbonus() {
        $plans = DB::table('plans')->where('site', 'mlm')->whereNull('deleted_at')->pluck('title', 'id')->toArray();

        return view('plans.createbonus')->with('plans', $plans);
    }

    public function bonuses() {
        $bonuses = Bonus::whereNull('deleted_at')->paginate(10);

        return view('plans.bonuses')->with('bonuses', $bonuses);
    }

    public function updatebonus($id, Request $request)
    {
        $plan = Plan::find($id);

        if (empty($plan)) {
            Flash::error('Plan not found');

            return redirect(route('plans.index'));
        }

        $validator = Validator::make($request->all(), [
            'commission' => 'required|lt:'.$plan->price,
            'plan_id' => 'required',
        ],
        [
            'required' => 'The :attribute field is required.',
            'lt' => 'Commission must be less than Plans Price('.$plan->price.').',
        ]);

        if ($validator->fails()) {
            Flash::error('Commission must be less than Plans Price('.$plan->price.').');
            return redirect(route('plans.bonus', $plan->id))
                        ->withErrors($validator)
                        ->withInput();
        }

        $levelSum = $request->input('level_1') + $request->input('level_2') + $request->input('level_3') + $request->input('level_4') + $request->input('level_5');

        if ($levelSum > 100) {
            Flash::error('Total percentage for levels can never be more than 100.');
            $validator->getMessageBag()->add('level_1', 'Total percentage for levels can never be more than 100.');
            return redirect(route('plans.bonus', $plan->id))
                        ->withErrors($validator)
                        ->withInput();
        }

        $bonusExist = Bonus::whereNull('deleted_at')->where('plan_id', $id)->first();
        if (!$bonusExist) {
            $bonus = new Bonus();
            $bonus->plan_id = $request->input('plan_id');
            if ($request->input('level_1') != '') {
                $bonus->level_1 = $request->input('level_1');
            }
            if ($request->input('level_2') != '') {
                $bonus->level_2 = $request->input('level_2');
            }
            if ($request->input('level_3') != '') {
                $bonus->level_3 = $request->input('level_3');
            }
            if ($request->input('level_4') != '') {
                $bonus->level_4 = $request->input('level_4');
            }
            if ($request->input('level_5') != '') {
                $bonus->level_5 = $request->input('level_5');
            }
            if ($request->input('commission') != '') {
                $bonus->commission = $request->input('commission');
            }
            $bonus->save();
        } else {
            $bonusExist->plan_id = $request->input('plan_id');
            if ($request->input('level_1') != '') {
                $bonusExist->level_1 = $request->input('level_1');
            }
            if ($request->input('level_2') != '') {
                $bonusExist->level_2 = $request->input('level_2');
            }
            if ($request->input('level_3') != '') {
                $bonusExist->level_3 = $request->input('level_3');
            }
            if ($request->input('level_4') != '') {
                $bonusExist->level_4 = $request->input('level_4');
            }
            if ($request->input('level_5') != '') {
                $bonusExist->level_5 = $request->input('level_5');
            }
            if ($request->input('commission') != '') {
                $bonusExist->commission = $request->input('commission');
            }
            $bonusExist->save();
        }

        Flash::success('Plan bonuses updated successfully.');

        return redirect(route('plans.bonuses'));
    }

    public function purchasePackage($package_id) {
        $user = \Auth::user();
        if (!$package_id) {
            Flash::error('Package ID not found.');

            return redirect(route('mlm.packages'));
        }

        $plan = Plan::find($package_id);
        if ( empty( $plan ) ) {
            Flash::error('Package not found.');

            return redirect(route('mlm.packages'));
        }

        $levelOneUser = $user->parent;
        $bonus = $plan->bonus;
        $subscription = $levelOneUser->subscriptions()->latest()->first();

        if ($levelOneUser && $subscription) {
            $subplan = $subscription->plan()->latest()->first();
            $subBonus = $subplan->with('bonus')->first()->bonus;
            if ($subplan && $subBonus) {
                $this->addCommission($user->id, $levelOneUser->id, $bonus, $subBonus, 1);

                if ($levelOneUser->parent_id != 0) {
                    $levelTwoUser = User::where('id', $levelOneUser->parent_id)->first();
                    $subscription = $levelTwoUser->subscriptions()->latest()->first();
                    
                    if ($subscription) {
                        $subplan = $subscription->plan()->latest()->first();
                        $subBonus = $subplan->with('bonus')->first()->bonus;
                        if ($subplan && $subBonus) {
                            $this->addCommission($user->id, $levelTwoUser->id, $bonus, $subBonus, 2);
                            
                            if ($levelTwoUser->parent_id != 0) {
                                $levelThreeUser = User::where('id', $levelTwoUser->parent_id)->first();
                                $subscription = $levelThreeUser->subscriptions()->latest()->first();
                                if ($subscription) {
                                    $subplan = $subscription->plan()->latest()->first();
                                    $subBonus = $subplan->with('bonus')->first()->bonus;
                                    if ($subplan && $subBonus) {
                                        $this->addCommission($user->id, $levelThreeUser->id, $bonus, $subBonus, 3);

                                        if ($levelThreeUser->parent_id != 0) {
                                            $levelFourUser = User::where('id', $levelThreeUser->parent_id)->first();
                                            $subscription = $levelThreeUser->subscriptions()->latest()->first();
                                            if ($subscription) {
                                                $subplan = $subscription->plan()->latest()->first();
                                                $subBonus = $subplan->with('bonus')->first()->bonus;
                                                if ($subplan && $subBonus) {
                                                    $this->addCommission($user->id, $levelFourUser->id, $bonus, $subBonus, 4);
                                
                                                    if ($levelFourUser->parent_id != 0) {
                                                        $levelFiveUser = User::where('id', $levelFourUser->parent_id)->first();
                                                        $subscription = $levelThreeUser->subscriptions()->latest()->first();
                                                        if ($subscription) {
                                                            $subplan = $subscription->plan()->latest()->first();
                                                            $subBonus = $subplan->with('bonus')->first()->bonus;
                                                            if ($subplan && $subBonus) {
                                                                $this->addCommission($user->id, $levelFiveUser->id, $bonus, $subBonus, 5);
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        $subscription = new Subscription();
        $subscription->plan_id = $package_id;
        $subscription->user_id = Auth::user()->id;
        $subscription->price = $plan->price;
        $subscription->status = 'active';
        $subscription->save();

        $transaction = new Transaction();
        $transaction->user_id = Auth::user()->id;
        $transaction->amount = $plan->price;
        $transaction->type = 'purchase';
        $transaction->status = 'pending';
        $transaction->save();

        Flash::success('Your purchase completed successfully.');
        return redirect(route('mlm.packages'));
    }

    private function addCommission($user_id, $receiver_id, $bonus, $subBonus, $level) {
        $percent = 0;
        if ($level == 1) {
            $percent = $subBonus->level_1;
        } else if ($level == 2) {
            $percent = $subBonus->level_2;
        } else if ($level == 3) {
            $percent = $subBonus->level_3;
        } else if ($level == 4) {
            $percent = $subBonus->level_4;
        } else if ($level == 5) {
            $percent = $subBonus->level_5;
        }
// echo $user_id . ' - ' . $receiver_id . ' - ' . $bonus->commission . ' - ' . $percent . ' - ' . $level;echo'<br />';
        if ($percent != 0) {
            $commission = new Commission();
            $commission->price = ( $bonus->commission * $percent ) / 100;
            $commission->user_id = $user_id;
            $commission->receiver_id = $receiver_id;
            $commission->level = $level;
            $commission->save();

            $transaction = new Transaction();
            $transaction->user_id = $receiver_id;
            $transaction->from = $user_id;
            $transaction->amount = ( $bonus->commission * $percent ) / 100;
            $transaction->type = 'commission';
            $transaction->status = 'pending';
            $transaction->save();
        }
    }
}
