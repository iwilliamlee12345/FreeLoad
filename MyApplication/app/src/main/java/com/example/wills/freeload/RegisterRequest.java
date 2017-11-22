package com.example.wills.freeload;

/**
 * Created by wills on 10/23/2017.
 */

import android.util.Log;

import com.android.volley.Response;
import com.android.volley.toolbox.StringRequest;

import java.util.HashMap;
import java.util.Map;

public class RegisterRequest extends StringRequest{

    private static final String TAG = "RegisterRequest";

    public static final String REGISTER_REQUEST_URL = "https://ec2-52-25-133-35.us-west-2.compute.amazonaws.com/Register2.php";
    private Map<String, String> params;

    public RegisterRequest(String name, String username, int age, String password, Response.Listener<String> listener) {
        super(Method.POST, REGISTER_REQUEST_URL, listener, null);
        params = new HashMap<>();
        params.put("name", name);
        params.put("age", age + "");
        params.put("username", username);
        params.put("password", password);
        Log.d(TAG, "Creating RegisterRequest");

    }


    @Override
    public Map<String, String> getParams() {
        Log.d(TAG, "Returning RegisterRequest MAP");
        return params;
    }
}
