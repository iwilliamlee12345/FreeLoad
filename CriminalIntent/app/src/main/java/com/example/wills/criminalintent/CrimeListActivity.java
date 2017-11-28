package com.example.wills.criminalintent;

import android.support.v4.app.Fragment;

/**
 * Created by wills on 11/24/2017.
 */

public class CrimeListActivity extends SingleFragmentActivity {
    public int helloWorld = 5;
    @Override
    protected Fragment createFragment() {
        return new CrimeListFragment();
    }
}
