package com.example.venuerecommendation.model;

import com.example.venuerecommendation.remotes.GoogleApiService;
import com.example.venuerecommendation.remotes.RetrofitBuilder;


public class Common {
    private static final String BASE_URL = "https://maps.googleapis.com/";

    public static GoogleApiService getGoogleApiService() {
        return RetrofitBuilder.builder().create(GoogleApiService.class);
    }
}
