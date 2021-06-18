package com.example.venuelocationfinder.url;

import com.example.venuelocationfinder.activity.IpAddress;

/**
 * Created by Belal on 9/5/2017.
 */

public class URLs {

    private static final String ROOT_URL = "http://"+ IpAddress.Ip_Address+"/VenueRecommender/Api.php?apicall=";
    public static final String latlon = "http://"+IpAddress.Ip_Address+"/VenueRecommender/locdb.php?";


    public static final String URL_REGISTER = ROOT_URL + "signup";
    public static final String URL_LOGIN= ROOT_URL + "login";
    public static final String URL_GROUP= ROOT_URL + "group";
    public static final String URL_TAGS= ROOT_URL + "tags";

}
