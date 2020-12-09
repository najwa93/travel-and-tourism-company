<?php

namespace App\Http\Controllers\Web;

use App\Models\Admin\Country\Country;
use App\Models\Admin\Flight\FlightDegree;
use App\Models\Admin\Hotel\Hotel;
use App\Models\Admin\Hotel\HotelRoom;
use App\Models\Admin\Hotel\RoomType;
use App\Models\User\FlightReservation\FlightReservation;
use App\Models\User\HotelReservation\HotelReservation;
use App\Models\User\Messages\Message;
use App\Models\User\Messages\MessageReply;
use App\Models\User\OfferReservation\OfferReservation;
use App\Models\User\Subscribe\Subscribe;
use App\Notifications\Msg;
use App\User;
use Carbon\Carbon;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class WebController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['hotelReservation']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $flight_degrees = FlightDegree::all()->pluck('name', 'id');
        $rated_messages = Message::where('show_as_rate', 1)->get();

        if ($rated_messages == null) {
            $rated_messages = null;
        }

        //return $rated_messages;
        //$replyMsg = "hello";
       // return view('emails.replyMsg', compact('replyMsg'));
        return view('Web.Main_view', compact('flight_degrees', 'rated_messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*     $user = Auth::user();

             $message = new Message();
             $message->user_id = $user->id;
             $message->user_name = $request->input('name');
             $message->email = $request->input('email');
             $message->message = $request->input('message');

             $message->save();
             return redirect()->back();*/

    }

    //send database notification
    public function send(Request $request)
    {
        $user = Auth::user();
        $msg = new Message();
        if ($user != null) {
            $msg->user_id = $user->id;
        }
        $msg->email = $request->input('email');
        $msg->user_name = $request->input('name');
        $msg->message = $request->input('message');
        $msg->is_read = 0;
        $msg->show_as_rate = 0;
        $msg->save();
        /* $user = User::whereHas('role', function($query){
             $query->where('name','Admin')->orWhere('name','Support');
         })->get();
         $message = new Message();

         $message->user_name = $request->input('name');
         $message->email = $request->input('email');
         $message->message = $request->input('message');

         $message->save();

         Notification::send($user,new Msg($message));*/
        return redirect()->back()->with('success','تم إرسال الرسالة سيتم الرد عليكم بأقرب وقت');

    }

    public function subscribe(Request $request)
    {
        $this->validate($request, ['email' => 'string', 'email', 'max:255', 'unique:users']);

        // $user = Auth::user();

        $email = $request->input('email');
        //$checkUser = Subscribe::where('email','=',$email)->first();
        // if ($checkUser == null){
        $subscriber = new Subscribe();
        // $subscriber->user_id = $user->id;
        $subscriber->email = $email;
        $subscriber->save();

        return redirect()->back()->with('success', 'تم الاشتراك بنجاح');
        //return view('Admin.SupportManagement.Index',compact('rated_messages'));
    }

    public function show_message_replies()
    {
        $user = Auth::user();
        $data = [];
        $msgs_data = [];
        $msgs = Message::where('user_id', $user->id)->whereHas('message_reply')->get();

        //return $msgs;
        foreach ($msgs as $msg) {
            $data['message_id'] = $msg->id;
            $data['message'] = $msg->message;
            foreach ($msg->message_reply as $msg_reply) {
                $data['msg_reply'] = $msg_reply->message_reply;
                $data['read_by_user'] = $msg_reply->read_by_user;
            }
            array_push($msgs_data, $data);
        }
        $msgs_replies = $msgs_data;
        // return $msgs_replies;
        return view('Web.Messages.index', compact('msgs_replies'));
    }


    public function delete_message($msgId)
    {
        $msg = Message::where('id', $msgId)
            ->with('message_reply')
            ->first();

        $msg->delete();
        return redirect()->back()->with('success', 'تمت عملية الحذف بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($messageId)
    {
        $msg = Message::where('id', $messageId)->first();
        $msg_reply = MessageReply::where('message_id', $msg->id)->first();
        $msg_reply->read_by_user = true;
        $msg_reply->save();
        return view('Web.Messages.show', compact('msg_reply'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    // update user profile
    public function editUserProfile()
    {
        $user = Auth::user();
        $countries = Country::all()->pluck('name', 'id');
        return view('Web.Auth.User.Update', compact(['user', 'countries']));
    }

    // update users
    public function updateUserProfile(Request $request)
    {
        $this->validate($request, ['email' => 'string', 'email', 'max:255', 'unique:users',
            'first_name' => ['required', 'string', 'max:255'],
            'user_name' => ['required', 'string', 'max:255'],
            'c_password' => ['required'],]);
        $user = Auth::user();
        if ($this->check($request->input('c_password'))) {
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->user_name = $request->input('user_name');
            $user->phone_number = $request->input('phone_number');
            $user->country_id = $request->input('country');
            $user->gender = $request->input('gender');
            $user->save();
            if (!is_null($request->input('password')) and ($request->input('password') == $request->input('password_confirmation'))) {
                $user->password = Hash::make($request->input('password'));
                $user->save();
            }
            if ($user->role_id != 8) {
                return redirect()->route('Main.index')->with('success','تم التعديل الملف الشخصي بنجاح');;
            } else {
                return redirect()->route('home_page.index')->with('success','تم تعديل الملف الشخصي بنجاح');
            }
        } else {
            return redirect()->back()->with('error','كلمة المرور غير صحيحة');
        }

    }

    protected function check($password)
    {
        if (Hash::check($password, Auth::user()->getAuthPassword())) {
            return true;
        }
        return false;
    }

    /* public function fetch(Request $request){
         if ($request->get('query')){
             $query = $request->get('query');
             $data = DB::table('cities')
                 ->where( 'name','like','%{$query}%')
                 ->get();
             $output = '<ul class="dropdown-menu" style="display: block;position: relative"> ';
                     foreach ($data as $row){
                         $output .= '<li><a href="#">'.$row->country_name.'</a></li>';
                     }
             $output .= '</ul>';
                     echo $output;

         }
     }*/

    // search hotels function
    public function searchHotels(Request $request)
    {
        $this->validate($request, [
            'city' => 'required|alpha',
            'customers_count' => 'required',
            'datepicker' => 'required',
            'datepicker1' => 'required',

        ]);

        // return Carbon::createFromFormat('Y-m-d H:i:s', Carbon::parse($request->datepicker))->format('Y-m-d');
        /*
                $checkIndate = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::parse($request->datepicker))->format('Y-m-d');
                $checkOutdate = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::parse($request->datepicker1))->format('Y-m-d');*/
        //  return $checkIndate;
        /*if ($checkIndate > $checkOutdate){
            return "hello";
            return redirect()->back()->with('error','يرجى إدخال تاريخ الوصول بشكل صحيح');
        }*/

        //return $request->input('datepicker1');

        // return $request->input('datepicker1');

        //return "heelo";
        $checkInDate = $request->input('datepicker');
        $checkOutDate = $request->input('datepicker1');
       /* if ($checkInDate >= $checkOutDate) {
            return redirect()->route('searchFlights')->with('warning', 'لاتوجدنتائج');
        }*/


        $hotels = [];
        $request->session()->put('checkin', $request->input('datepicker'));
        $request->session()->put('checkout', $request->input('datepicker1'));
        // $request->session()->put('checkout', $request->input('checkout'));
        //return($request->session()->get('checkin'));
        $city = $request->input('city');
        $customers_count = $request->input('customers_count');
        $hotels_q = Hotel::whereHas('city', function ($query) use ($city) {
            $query->where('name', 'like', "%" . $city . "%");
        })
            /*->whereHas('hotel_room', function ($query) use ($customers_count) {
                $query->where('is_available', '=', 1);
                $query->where('customers_count', '=', $customers_count);
            })*/
            ->get();

        //return $hotels_q;
        foreach ($hotels_q as $hotel) {
            $hotel_rooms = HotelRoom::where('hotel_id', $hotel->id)->where('is_available', '=', 1)
                ->where('customers_count', '=', $customers_count)
                ->get();
            //return $hotels;
            // array_push($hotels,$hotel_rooms);
            $hotels[] = $hotel_rooms;
        }

        // return $hotels;
        $data = [];
        $hotel_data = [];
        foreach ($hotels as $hotelRoom) {
            foreach ($hotelRoom as $room) {
                $data['hotel_id'] = $room['hotel_id'];
                $data['hotel_name'] = $room->hotel['name'];

                $data['room_id'] = $room['id'];
                $data['room_type'] = $room->room_type->name;
                $data['customers_count'] = $room['customers_count'];
                $data['room_details'] = $room['details'];
                $data['night_price'] = $room['night_price'];
                array_push($hotel_data, $data);
            }
        }

       // return $hotel_data;

        return view('Web.Search.Hotel.searchHotel', compact('hotel_data'));
    }

    // hotel details
    public function hotelDetails($hotelId, $roomId)
    {
        $user = Auth::user();
        $room = HotelRoom::where('id', $roomId)->first();
        $hotel = Hotel::where('id', $hotelId)
            ->with('hotelImage')
            ->first();

        //return $hotel;
        // $request->session()->put('room',$room->id);
        //return $hotel;
        /*$hotel_data = [];
        $hotelArr = [];
           $hotel_data['hotel_id'] = $hotel->id;
           $hotel_data['hotel_stars'] = $hotel->stars;
           $hotel_data['hotel_details'] = $hotel->stars;
        foreach ($hotel->hotelImage as $img){
            $hotel_data['hotel_img'] = $img->img_path;
            array_push($hotelArr,$hotel_data);
        }
   */
        // return $hotel;
        return view('Web.Search.Hotel.searchHotelDetails', compact('hotel', 'room', 'user'));
    }

    public function hotelReservation($hotelId, $roomId)
    {
        if (Auth::user()) {
            $user = Auth::user();
            $room = HotelRoom::where('id', $roomId)->first();
            $hotel = Hotel::where('id', $hotelId)->first();
            //return $user;
            return view('Web.Search.Hotel.completeReservation', compact('room', 'hotel', 'user'));
        } else {
            return redirect()->intended();
        }
    }

    public function completeHotelReservation(Request $request, $hotelId, $roomId)
    {
        $this->validate($request, ['credit' => 'required', 'credit_number' => 'required|numeric|min:0']);
        $user = Auth::user();
        $room = HotelRoom::where('id', $roomId)->first();
        $user->credit = $request->input('credit');
        $userBalance = $request->input('credit_number');
        if ($userBalance < $room->night_price) {
            return redirect()->back()->with('error', 'الرصيد غيركافي لعملية الحجز');
        }
        $checkResevations = HotelReservation::where('user_id',$user->id)->get();
        foreach ($checkResevations as $check){
            if ($check->room_id == $room->id ){
                return redirect()->back()->with('error','لقد قمت بعملية الحجز مسبقا');
            }
        }
      /*  if ($room->is_available == 0){
          //  return "hello";
            return redirect()->back()->with('error','لقد قمت بعملية الحجز مسبقا');
        }*/
        $room->is_available = 0;
        $room->save();
        $hotelReservation = new HotelReservation();
        $hotelReservation->user_id = Auth::user()->id;
        $hotelReservation->hotel_id = $hotelId;
        $hotelReservation->room_id = $roomId;
        $checkin = Session::get('checkin');
        $checkout = Session::get('checkout');

        $hotelReservation->check_in_date = $checkin;
        $hotelReservation->check_out_date = $checkout;
        $hotelReservation->is_booked = true;
        $hotelReservation->reservation_cost = $room->night_price;
        $hotelReservation->save();

        $night_price = $room->night_price;
        $balance = $request->input('credit_number');
        $user->credit_balance = $balance - $night_price;
        $user->save();
        return redirect()->route('showUserReservations')->with('success', 'تمت عملية حجز فندق بنجاح');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */


    public function showUserReservations()
    {
        $user = Auth::user();

        $user_reservation = User::where('id', $user->id)
            ->with('hotel_reservation')
            ->with('flight_reservation')
            ->get();
        // return $user_reservation;
        $hotel_reservation_data = [];
        $flight_reservation_data = [];
        $allData = [];
        $hotel = [];
        $flight = [];
        foreach ($user_reservation as $value) {
            foreach ($value->hotel_reservation as $hotelReserv) {
                $hotel['hotel_reservation_id'] = $hotelReserv->id;
                $hotel['hotel_id'] = $hotelReserv->hotel_id;
                $hotel['hotel'] = $hotelReserv->hotel->name;
                $hotel['city'] = $hotelReserv->hotel->city->name;
                $hotel['room_type'] = $hotelReserv->room->room_type->name;
                $hotel['room_details'] = $hotelReserv->room->details;
                $hotel['night_price'] = $hotelReserv->reservation_cost;
                $hotel['customers_count'] = $hotelReserv->room->customers_count;
                $hotel['offer_id'] = $hotelReserv->offer_id;
                array_push($hotel_reservation_data, $hotel);
            }
            $allData['hotelReservation'] = $hotel_reservation_data;
            foreach ($value->flight_reservation as $flightReserv) {
                $flight['flight_reservation_id'] = $flightReserv->id;
                $flight['flight_id'] = $flightReserv->flight_id;
                $flight['source_city'] = $flightReserv->flight->source_city->name;
                $flight['destination_city'] = $flightReserv->flight->destination_city->name;
                $flight['date'] = $flightReserv->flight->date;
                $flight['time'] = $flightReserv->flight->time;
                $flight['flight_degree'] = $flightReserv->flight_degree->name;
                $flight['reservation_price'] = $flightReserv->reservation_price;

                $flight['offer_id'] = $flightReserv->offer_id;
                array_push($flight_reservation_data, $flight);
            }
            $allData['flightReservation'] = $flight_reservation_data;
        }
        //return $allData;
        return view('Web.reservations.userReservation', compact('user', 'allData'));
    }

    public function deleteHotelReservation($hotelReservationid)
    {
        $hotelReservation = HotelReservation::find($hotelReservationid);
        //return $hotelReservation;

        if ($hotelReservation->offer_id != null){
            $offer_reservation = OfferReservation::where('offer_id',$hotelReservation->offer_id)->first();
            $offer_reservation->delete();
            $offer_reservation = FlightReservation::where('offer_id',$hotelReservation->offer_id)->first();
            $offer_reservation->delete();
        }
        $roomId = $hotelReservation->room_id;

        $room = HotelRoom::where('id', $roomId)->first();

        $room->is_available = true;

        $room->save();
        $hotelReservation->delete();

        return redirect()->back();
    }

    public function deleteFlightReservation($flightReservationid)
    {
        $flightReservation = FlightReservation::find($flightReservationid);

        if ($flightReservation->offer_id != null){
            $offer_reservation = OfferReservation::where('offer_id',$flightReservation->offer_id)->first();
            $offer_reservation->delete();
            $hotel_reservation = HotelReservation::where('offer_id',$flightReservation->offer_id)->first();
            $roomId = $hotel_reservation->room_id;

            $room = HotelRoom::where('id', $roomId)->first();

            $room->is_available = true;

            $room->save();
            $hotel_reservation->delete();
        }

        $flightReservation->delete();

        return redirect()->back();
    }
}
