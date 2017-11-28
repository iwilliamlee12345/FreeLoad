package com.example.wills.criminalintent;

import java.util.Date;
import java.util.UUID;

/**
 * Created by wills on 11/21/2017.
 */

public class Crime {
    private UUID mId;
    private String mTitle;
    private Date mDate;
    private boolean mSolved;

    public Crime() {
        //Generate unique identifer
        mId = UUID.randomUUID();
        //Sets date to the current date
        mDate = new Date();
    }

    public UUID getId() {
        return mId;
    }


    public String getTitle() {
        return mTitle;
    }

    public void setTitle(String mTitle) {
        this.mTitle = mTitle;
    }

    public Date getDate() {
        return mDate;
    }

    public void setDate(Date date) {
        this.mDate = date;
    }

    public boolean isSolved() {
        return mSolved;
    }

    public void setSolved(boolean solved) {
        this.mSolved = solved;
    }
}
