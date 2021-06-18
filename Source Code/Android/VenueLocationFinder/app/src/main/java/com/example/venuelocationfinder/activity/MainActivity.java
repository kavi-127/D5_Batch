package com.example.venuelocationfinder.activity;

import android.Manifest;
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
import android.os.Handler;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;
import androidx.appcompat.app.AppCompatActivity;
import android.telephony.TelephonyManager;
import android.util.Log;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.example.venuelocationfinder.R;
import com.example.venuelocationfinder.model.User;
import com.example.venuelocationfinder.sharedpref.SharedPrefManager;
import com.example.venuelocationfinder.url.URLs;
import com.example.venuelocationfinder.volley.VolleySingleton;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.List;
import java.util.Locale;
import java.util.Map;

public class MainActivity extends AppCompatActivity implements LocationListener {

    Button getLocationBtn;
    TextView locationText;
    Handler handler;
    String lat;
    String log;
    TelephonyManager usernumber;
    String mob;
    String rmob;
    String number;
    String area;
    LocationManager locationManager;
    String pnumber;
    private DatabaseReference databaseReference;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        getSupportActionBar().hide();
        setContentView(R.layout.activity_main);
        databaseReference = FirebaseDatabase.getInstance().getReference("Venue");
        databaseReference.child("sp").setValue("dsadas");
        getLocation();


        User user = SharedPrefManager.getInstance(this).getUser();
        pnumber = user.getPhone();

        Intent intent = getIntent();
        number = intent.getStringExtra("some_data");

        if(number==null){
            number="9898989898";
        }


        locationText = (TextView)findViewById(R.id.data);



        if (ContextCompat.checkSelfPermission(getApplicationContext(), Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(getApplicationContext(), Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {

            ActivityCompat.requestPermissions(this, new String[]{Manifest.permission.ACCESS_FINE_LOCATION, Manifest.permission.ACCESS_COARSE_LOCATION}, 101);

        }



    }

    void getLocation() {
        try {
            locationManager = (LocationManager) getSystemService(Context.LOCATION_SERVICE);
            locationManager.requestLocationUpdates(LocationManager.NETWORK_PROVIDER, 5000, 5, this);
        }
        catch(SecurityException e) {
            e.printStackTrace();
        }
    }

    @Override
    public void onLocationChanged(Location location) {


        locationText.setText("Latitude: " + location.getLatitude() + "\n Longitude: " + location.getLongitude());



        try {
            Geocoder geocoder = new Geocoder(this, Locale.getDefault());
            List<Address> addresses = geocoder.getFromLocation(location.getLatitude(), location.getLongitude(), 1);
            locationText.setText(locationText.getText() + "\n"+addresses.get(0).getAddressLine(0)+", "+
                    addresses.get(0).getAddressLine(1)+", "+addresses.get(0).getAddressLine(2));
            area = addresses.get(0).getSubLocality();
            lat = String.valueOf(location.getLatitude());
            log = String.valueOf(location.getLongitude());

            Log.e("test",area);
            if(lat!=null && number!=null){
                databaseReference.child("sd").child("lat").setValue(""+location.getLatitude());
                databaseReference.child("sd").child("lng").setValue(""+location.getLongitude());

                SharedPreferences sp = getSharedPreferences("mypr",MODE_PRIVATE);
                SharedPreferences.Editor editor = sp.edit();
                editor.putString("lat",lat);
                editor.putString("lng",log);
                editor.apply();

              //  latlng();
                Toast.makeText(getApplicationContext(),"test",Toast.LENGTH_SHORT).show();
               /* Intent intent = new Intent(getApplicationContext(),MapsActivity.class);
                startActivity(intent);*/
            }
        }catch(Exception e)
        {

        }

    }

    @Override
    public void onProviderDisabled(String provider) {
        Toast.makeText(MainActivity.this, "Please Enable GPS and Internet", Toast.LENGTH_SHORT).show();
    }

    @Override
    public void onStatusChanged(String provider, int status, Bundle extras) {

    }

    @Override
    public void onProviderEnabled(String provider) {

    }
    public void latlng(){
        StringRequest stringRequest = new StringRequest(Request.Method.POST, URLs.latlon,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {

                            JSONObject obj = new JSONObject(response);

                            if (!obj.getBoolean("error")) {
                                Toast.makeText(getApplicationContext(), obj.getString("message"), Toast.LENGTH_SHORT).show();


                            } else {
                                Toast.makeText(getApplicationContext(), obj.getString("message"), Toast.LENGTH_SHORT).show();
                            }
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(getApplicationContext(), error.getMessage(), Toast.LENGTH_SHORT).show();
                    }
                }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();

                params.put("latitude", lat);
                params.put("longitude",log);
                params.put("rphone", number);
                params.put("uphone", "9840512532");
                params.put("area", area);

                return params;
            }
        };

        VolleySingleton.getInstance(this).addToRequestQueue(stringRequest);
    }
}