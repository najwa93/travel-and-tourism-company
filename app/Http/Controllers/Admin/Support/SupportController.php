<?php

namespace App\Http\Controllers\Admin\Support;

use App\Models\User\Messages\Message;
use App\Models\User\Messages\MessageReply;
use App\Models\User\Subscribe\Subscribe;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*  public function index()
      {
          $user = Auth::user();
          $messages = $user->notifications;
        //  $messages = Message::all();
        //  return $messages;
          return view('Admin.SupportManagement.Index',compact('messages'));
      }*/

    public function index_messages()
    {

        //return $users;
        $user = Auth::user();
        $messages = Message::all();
        $subscribers = Subscribe::all();
        //  $messages = Message::all();
        // return $messages;
        return view('Admin.SupportManagement.Index', compact('messages','subscribers'));
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
        //

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($messageId)
    {
        $user = Auth::user();
        $message = Message::find($messageId);
        //$message1 = $user->Notifications()->data;


        //return $message;
        //return view('emails.replyMsg');
        return view('Admin.SupportManagement.Show', compact('message'));
    }

    public function send_reply(Request $request, $messageId)
    {
        $this->validate($request,[
            'message' => 'required',
        ]);
        $user = Auth::user();
        $msg = Message::find($messageId);

        if ($msg->is_read == 1) {
          //  return redirect('Admin/index_messages')->with('error', 'Reply For This Message Sent Before');
            return redirect()->back()
                ->with('error','تم الرد على هذه الرسالة مسبقا');
        }
        $msg->is_read = true;
        $toEmail = $msg->email;
        $msg->save();

        $message_reply = new MessageReply();
        $message_reply->user_id = $user->id;
        $message_reply->message_id = $msg->id;
        $msgReply = $request->input('message');
        $message_reply->message_reply = $msgReply;
        $message_reply->read_by_user = false;
        $message_reply->save();
        $data = ['replyMsg' => $msgReply];

        $checkEmail = User::where('id', $msg->user_id)->first();

        if ($checkEmail == null) {
            Mail::send('emails.replyMsg', $data, function ($message) use ($toEmail) {
                $message->to($toEmail);
                //$message->from('travelRoCompany@gmail.com');
                $message->subject("TravelRo Reply Messages");
            });
        }
        //$msg->markAsRead();

        //return $message;
        return redirect()->route('messages')->with('success','تم إرسال الرد');
    }

    public function show_as_rate(Request $request, $messageId)
    {
        $msg = Message::where('id',$messageId)->first();

        if ($msg->is_read == 0) {
            //  return redirect('Admin/index_messages')->with('error', 'Reply For This Message Sent Before');
            return redirect()->back()->with('warning','يرجى قراءة الرسالة أولاً');
        }
        $msg->show_as_rate = true;
        $msg->save();

        return redirect()->route('messages');
    }


    public function send_email_for_users(Request $request)
    {
        $this->validate($request, [
            'msg-users' => 'required',
        ]);
        $replyMsg = $request->input('msg-users');
        $data = ['replyMsg' => $replyMsg];

        $users = User::where('role_id','=',8)
            //->where('role_id','!=',9)
            ->get();

        //return $users;

        foreach ($users as $user){
            Mail::send('emails.replyMsg', $data, function ($message) use ($user) {
                $message->to($user->email);
                //$message->from('travelRoCompany@gmail.com');
                $message->subject("TravelRo Company");
            });
        }

        //$msg->markAsRead();

        //return $message;
        return redirect()->route('messages')->with('success','تم إرسال رسالة لجميع المستخدمين بنجاح');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($meesageId)
    {
        $message = Message::where('id',$meesageId)->first();
        $message->message_reply()->delete();
        $message->delete();
        return redirect()->back()->with('success', 'تمت عملية الحذف بنجاح');
    }

    public function deleteSubscribe($email){
        $subscriber = Subscribe::where('email','=',$email)->first();
        $subscriber->delete();
        return redirect()->back()->with('success', 'تمت عملية الحذف بنجاح');
    }
}
