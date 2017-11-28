package com.example.wills.criminalintent;

import android.app.Activity;
import android.content.Intent;
import android.support.v4.app.Fragment;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.CompoundButton;
import android.widget.EditText;

import java.util.UUID;

import static android.app.Activity.RESULT_OK;

/**
 * Created by wills on 11/21/2017.
 */

public class CrimeFragment extends Fragment {

    private static final String ARG_CRIME_ID = "crime_id";
    private static final String HAS_CRIME_CHANGED = "com.example.marco.criminalintent.has_crime_changed";

    private Crime mCrime;
    private boolean mHasCrimeChanged;
    private EditText mTitleField;
    private Button mDateButton;
    private CheckBox mSolvedCheckBox;

    /**
     * Reason:
     * newInstance is needed to attach arguments to fragments
     *      attaching arguments must be done when fragments are created but before
     *      it is added to the activity
     * newInstance will be used instead of the constructor.
     *      creating the fragment with the arguments.
     *
     * @param
     * @return (Return the created fragment)
     */
    public static CrimeFragment newInstance(UUID crimeID) {
        Bundle args = new Bundle();
        args.putSerializable(ARG_CRIME_ID, crimeID);
        CrimeFragment fragment = new CrimeFragment();
        fragment.setArguments(args);
        return fragment;
    }

    /**
     * hasCrimeChanged tells whether or not crime was changed by user
     * @param result -Intent created from CrimeFragment from Function: returnResult()
     * @return boolean if crime was changed
     */
    public static boolean hasCrimeChanged(Intent result) {
        //Returns when crime is changed
        return result.getBooleanExtra(HAS_CRIME_CHANGED, false);
    }

    /**
     * Return crimeID that was created from CrimeFragment
     * @param result Intent created from CrimeFragment's returnResult();
     * @return UUID of the crime that was created from CrimeFragment
     */
    public static UUID getCrimeId(Intent result) {
        return (UUID)result.getSerializableExtra(ARG_CRIME_ID);
    }

    /**
     * Create intent and store in boolean if crime changed
     * Also store which crime was changed
     */
    private void returnResult() {
        Intent data = new Intent();
        data.putExtra(HAS_CRIME_CHANGED, mHasCrimeChanged);
        data.putExtra(ARG_CRIME_ID, mCrime.getId());
        //NOTE: use getActivity() since Fragment cannot setresult
        getActivity().setResult(RESULT_OK, data);
    }


    /**
     * Create the fragment and set crime member variable to passed
     *      crimeID made in newInstance(UUID crimeID)
     * @param savedInstanceState
     */
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        UUID crimeId = (UUID)getArguments().getSerializable(ARG_CRIME_ID);
        mCrime = CrimeLab.get(getActivity()).getCrime(crimeId);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.fragment_crime, container, false);

        mTitleField = (EditText)v.findViewById(R.id.crime_title);
        mTitleField.setText(mCrime.getTitle());
        mTitleField.addTextChangedListener(new TextWatcher() {
            @Override
            public void beforeTextChanged(
                    CharSequence s, int start, int count, int after) {
            // This space intentionally left blank
            }
            @Override
            public void onTextChanged(
                    CharSequence s, int start, int before, int count) {
                mCrime.setTitle(s.toString());
                mHasCrimeChanged = true;

            }
            @Override
            public void afterTextChanged(Editable s) {

            }
        });

        mDateButton = (Button)v.findViewById(R.id.crime_date);
        mDateButton.setText(mCrime.getDate().toString());
        mDateButton.setEnabled(false);

        mSolvedCheckBox = (CheckBox)v.findViewById(R.id.crime_solved);
        mSolvedCheckBox.setChecked(mCrime.isSolved());
        mSolvedCheckBox.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {
            @Override //Listen to see if checkbox is changed
            public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
                mCrime.setSolved(isChecked);
                mHasCrimeChanged = true;
                returnResult();
            }
        });
        return v;
    }

}

