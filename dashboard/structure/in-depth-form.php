<script>'use strict';</script>
<style>
    .form-hidden{
        display: none;
        transition:0.4sec;
    }
    .form-active{
        display: block;
        transition:0.4sec;
    }
    .freq, .days-label{
        display: block;
        margin-top: 15px;
        margin-bottom: 15px;
    }
    

</style>
<?php 
    session_start();
    require('db_Conn.php');
?>
<form id="add-new-med" onsubmit="return false" method="post">
    <div id="step-1" class="form-active">
        <div>
            <label for="">Medicine Name</label>
            <input type="text" name="" id="">
        </div>

        <div>
            <label for="">Type of medicine</label>
            <input type="text" name="" id="">
            <select name="" id="">
                <option value="">pill</option>
                <option value="">capsule</option>
                <option value="">liquid</option>
                <option value="">drops</option>
                <option value="">inhaler</option>
                <option value="">injection</option>
            </select>
        </div>

        <div>
            <label for="">Strength</label>
            <input type="text" name="" id="">
            <select name="" id="">
                <option value="">mg</option>
                <option value="">ml</option>
                <option value="">g</option>
                <option value="">mcg or μg</option>
            </select>
        </div>
        <div>
            <h5>Do you take this medicine everday?</h5>
            <label for="">
                <input type="radio" id="daily" value="yes" name="take-med-everyday">Yes
            </label>
            <label for="">
                <input type="radio" id="weekly" value="no" name="take-med-everyday">No
            </label>
        </div>

        <div>
            <a href="#" class="btn btn-step-1">Next</a>
        </div>
    </div>
            
    <div class="daily-frequency form-hidden">
        <div>
            <h5>How Often Do you Take It</h5>
            <br>
            <label for="">
                <input type="radio" id="" value="1" name="med-frequency-daily">once daily
            </label>
            <br>
            <label for="">
                <input type="radio" id="" value="2" name="med-frequency-daily">twice daily
            </label>
            <br>
            <label for="">
                <input type="radio" id="" value="3" name="med-frequency-daily">thrice daily
            </label>
        </div>
        <div>
            <a href="#" class="btn btn-back-daily">Back</a>
            <a href="#" class="btn btn-next-daily">Next</a>
        </div>
    </div> 

    <div class="time-freq-div form-hidden">
        <h5>At what time you take doses?</h5>
        <div class="time-daily-frequency">
               
        </div>
        <div class="btn-div-time">
            <a href="#" class="btn btn-back-time">Back</a>
        </div>
    </div>
    

    <div class="weekly-form form-hidden">
        <h5>How Often Do you Take It In A Week?</h5>
        <br>
        <label for="">
            <input type="radio" id="" value="1" name="med-frequency-weekly">once a week
        </label>
        <br>
        <label for="">
            <input type="radio" id="" value="2" name="med-frequency-weekly">twice a week
        </label>
        <br>
        <label for="">
            <input type="radio" id="" value="3" name="med-frequency-weekly">thrice a week
        </label>

        <div class="back-btn-week-freq">
            <a href="#" class="btn btn-back-weekly">Back</a>
            <a href="#" class="btn btn-next-weekly">Next</a>
        </div>
    </div>

    <div class="weekly-frequency-days form-hidden">
        <h5>When Do You Take This Medicine</h5>
        <div class="days-checkboxes">
            <label for="monday" class="days-label">
                <input type="checkbox" value="Monday" name="days[]" id="monday" class="days">Monday
            </label>
            <label for="tuesday" class="days-label">
                <input type="checkbox" value="Tuesday" name="days[]" id="tuesday" class="days">Tuesday
            </label>
            <label for="wednes" class="days-label">
                <input type="checkbox" value="Wednessday" name="days[]" id="wednes" class="days">Wednessday
            </label>
            <label for="thurs" class="days-label">
                <input type="checkbox" value="Thursday" name="days[]" id="thurs" class="days">Thursday
            </label>
            <label for="friday" class="days-label">
                <input type="checkbox" value="Friday" name="days[]" id="friday" class="days">Friday
            </label>
            <label for="satur" class="days-label">
                <input type="checkbox" value="Saturday" name="days[]" id="satur" class="days">Saturday
            </label>
            <label for="sunday" class="days-label">
                <input type="checkbox" value="Sunday" name="days[]" id="sunday" class="days">Sunday
            </label>
        </div>
        <div class="back-btn-week-freq">
            <a href="#" class="btn btn-back-week-days">Back</a>
            <a href="#" class="btn btn-next-week-days">Next</a>
        </div>
    </div>

    <div class="weekly-form-time-inputs form-hidden">
        <div class="time-inputs">
        
        </div>

        <div class="">
        
        </div>
    </div>

    <input type="submit" value="Add Medicine" name="add-daily-med" id="add-daily-med" style="display: none;">
</form>
           

<script>

    /*
        *Variables
        
        *daily dose frequency
        *weekly dose frequency

        *show next div function
        *show previous function

        * append time labels and input in daily frequency
    */

    const formEle = document.querySelector('#add-new-med'); 
    const divStep1Ele = document.querySelector('#step-1'); 
    const step1BtnEle = document.querySelector('.btn-step-1'); 
    const dailyRadioELe = document.querySelector('#daily');
    const weeklyRadioELe = document.querySelector('#weekly');

    // daily form variable
    const divDailyELe = document.querySelector('.daily-frequency');
    const nextBtnDailyELe = document.querySelector('.btn-next-daily');
    const backBtnDailyELe = document.querySelector('.btn-back-daily');
    const divTimeDaily = document.querySelector('.time-freq-div');
    const timeDailyFreq = document.querySelector('.time-daily-frequency');
    const btnBackTimeEle = document.querySelector('.btn-back-time');

    const radioDailyFreqEle = document.querySelectorAll('[name="med-frequency-daily"]');
    

    const freq = ['First', 'Second', 'Third'];

    const label1 = document.createElement('label');
    const inputEle1 = document.createElement('input');
    const labelTextNode1 = document.createTextNode(`Select time for ${freq[0]} dose `);

    const label2 = document.createElement('label');
    const inputEle2 = document.createElement('input')
    const labelTextNode2 = document.createTextNode(`Select time for ${freq[1]} dose `);

    const label3 = document.createElement('label');
    const inputEle3 = document.createElement('input')
    const labelTextNode3 = document.createTextNode(`Select time for ${freq[2]} dose `);
    
    
    // Weekly form Variables
    const divWeeklyELe = document.querySelector('.weekly-form');
    const divWeekDaysELe = document.querySelector('.weekly-frequency-days');
    const weekFreqBackBtn = document.querySelector('.btn-back-weekly');
    const weekFreqNextBtn = document.querySelector('.btn-next-weekly');
    const radioWeeklyFreqEle = document.querySelectorAll('[name="med-frequency-weekly"]');
    const daysEle = document.querySelectorAll('[name="days[]"]');
    const btnBackWeekDays = document.querySelector('.btn-back-week-days');
    const btnNextWeekDays = document.querySelector('.btn-next-week-days');


    step1BtnEle.addEventListener('click', function(){
        // Check if daily frequency is check == true
        if(dailyRadioELe.checked == true){

            // Show daily Med Form  
            showNext(divStep1Ele, divDailyELe);
            
            // previous button daily frequency form
            backBtnDailyELe.addEventListener('click', function(){
                showPrev(divDailyELe, divStep1Ele);
            });

            // Next button daily frequency form
            nextBtnDailyELe.addEventListener('click', function(){
                if(radioDailyFreqEle[0].checked == true){
                    // add one time's input
                    appendDailyTimeNodes(timeDailyFreq, label1, labelTextNode1, inputEle1, `freq--1`, `freq--1`, `freq--1`);
                    showNext(divDailyELe, divTimeDaily); 
                }
                else if (radioDailyFreqEle[1].checked == true){    
                    appendDailyTimeNodes(timeDailyFreq, label1, labelTextNode1, inputEle1, `freq--1`, `freq--1`, `freq--1`);
                    appendDailyTimeNodes(timeDailyFreq, label2, labelTextNode2, inputEle2, `freq--2`, `freq--2`, `freq--2`);
                    showNext(divDailyELe, divTimeDaily); 
                        
                }
                else if(radioDailyFreqEle[2].checked == true){
                    // add three time's inputs
                    appendDailyTimeNodes(timeDailyFreq, label1, labelTextNode1, inputEle1, `freq--1`, `freq--1`, `freq--1`);
                    appendDailyTimeNodes(timeDailyFreq, label2, labelTextNode2, inputEle2, `freq--2`, `freq--2`, `freq--2`);
                    appendDailyTimeNodes(timeDailyFreq, label3, labelTextNode3, inputEle3, `freq--3`, `freq--3`, `freq--3`);
                    showNext(divDailyELe, divTimeDaily); 
                    }
                else{
                    alert('Please select dose frequency');
                }
                
            });
            
            // back button time frequency form
            btnBackTimeEle.addEventListener('click', function(){
                // remove all child elements in .time-daily-frequency
                const timeDailyFreqChildren = document.querySelectorAll('.freq');

                for(i = 0; i < timeDailyFreqChildren.length; i++){
                    if(timeDailyFreqChildren[i].classList.contains('freq')){
                        timeDailyFreqChildren[i].remove();
                    }
                    else{
                        break;
                    }
                }

                showPrev(divTimeDaily, divDailyELe);

            });

        }
        
        // Check if weekly frequency is checked
        else{
            // display radios for weekly frequency
            showNext(divStep1Ele, divWeeklyELe)

            // back button week frequency
            weekFreqBackBtn.addEventListener('click', function(){
                showPrev(divWeeklyELe, divStep1Ele);
            });

            // Next button weekly frequency form
            // check if any radio is checked
            weekFreqNextBtn.addEventListener('click', function(){
               
                
            });

            // Week days div back button 
            btnBackWeekDays.addEventListener('click', function(){
                showPrev(divWeekDaysELe, divWeeklyELe)
            });

        }
    });

    //Show next Step 
    function showNext(activeDivEle, nextDivEle){
        // Hide previous inputs
        activeDivEle.classList.add('form-hidden');
        activeDivEle.classList.remove('form-active');

        // display next inputs
        nextDivEle.classList.remove('form-hidden');
        nextDivEle.classList.add('form-active');
    }

    // Show Previous Step
    function showPrev(activeDivEle, prevDivEle){
        // Hide active inputs
        activeDivEle.classList.add('form-hidden');
        activeDivEle.classList.remove('form-active');

        // display Prev inputs
        prevDivEle.classList.remove('form-hidden');
        prevDivEle.classList.add('form-active');
    }

    function appendDailyTimeNodes(parentELe, labelELe, lableText, inputEle, className, name, controlId){
        // create labels for time
        // create text node for time
        // append text node with label
        // append input for label
        // append label for parent
        // set attribute of type
        // set attribute of class
        // set attribute of name
        // set attribute of id for label
        // set attribute of id for input

        labelELe.appendChild(lableText);
        labelELe.appendChild(inputEle);
        parentELe.appendChild(labelELe);
        inputEle.setAttribute('type', 'time');

        inputEle.setAttribute('name', name);
        inputEle.setAttribute('class', className);
        inputEle.setAttribute('id', controlId);
        labelELe.setAttribute('id', controlId);
        
        labelELe.classList.add('freq');
    }

    
   
</script>