package com.example.venuelocationfinder.listner;

import android.content.BroadcastReceiver;
import android.content.ComponentName;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.pm.PackageManager;
import android.location.Address;
import android.location.Geocoder;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;
import android.telephony.SmsMessage;
import android.util.Log;
import android.widget.Toast;

import com.example.venuelocationfinder.activity.MainActivity;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;

import java.util.List;
import java.util.Locale;


public class SmsListener extends BroadcastReceiver{

    private SharedPreferences preferences;
    private MainActivity mc;
    public static final String SHARED_PREF_NAME = "mysharedpref";
    public static final String KEY_PHONE = "keyname";
    private DatabaseReference databaseReference;
    private String phone;
    LocationManager locationManager;
    Context context;


    @Override
    public void onReceive(Context context, Intent intent) {
        // TODO Auto-generated method stub
        context=this.context;

        if(intent.getAction().equals("android.provider.Telephony.SMS_RECEIVED")){

            Log.e("sdssd","dsdsd");
            Bundle bundle = intent.getExtras();           //---get the SMS message passed in---
            SmsMessage[] msgs = null;
            String msg_from;
            if (bundle != null){
                Log.e("sdssd","dfdfsdfsdfsdfsdf");

             //   databaseReference = FirebaseDatabase.getInstance().getReference("venuerecommendation");
                //---retrieve the SMS message received---
                try{
                    Object[] pdus = (Object[]) bundle.get("pdus");
                    msgs = new SmsMessage[pdus.length];
                    for(int i=0; i<msgs.length; i++){
                        msgs[i] = SmsMessage.createFromPdu((byte[])pdus[i]);
                        msg_from = msgs[i].getOriginatingAddress();
                        String msgBody = msgs[i].getMessageBody();
                        Toast.makeText(context, "Message"+msgBody, Toast.LENGTH_SHORT).show();
                        Log.e("Sms",msgBody);
                        Log.e("phone",msg_from);

                       String[] msgar = msgBody.split("@");

                        if(msgar[0].equalsIgnoreCase("request")){

                            phone = msgar[2];
                            Intent intent1 = new Intent();
                            intent1.setClassName("com.example.venuelocationfinder", "com.example.venuelocationfinder.activity.MainActivity");
                            intent1.putExtra("some_data",msgar[2]);
                            intent1.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                            context.startActivity(intent1);

                        }
                        else if(msgar[0].equalsIgnoreCase("meetup")) {

                            Intent intent1 = new Intent();
                            intent1.setClassName("com.example.venuelocationfinder", "com.example.venuelocationfinder.activity.PlaceOnMapActivity");
                            intent1.putExtra("name",msgar[1]);
                            intent1.putExtra("lat",msgar[2]);
                            intent1.putExtra("lng",msgar[3]);
                            intent1.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                            context.startActivity(intent1);
                        }
                    }
                }catch(Exception e){
                    Log.e("Exception caught",e.getMessage());
                }
            }
        }
    }



}
