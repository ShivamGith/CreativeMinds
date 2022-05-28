/*
    * This file contains all the functions which are directly or indirectly related to the test.
*/

// To Start the timer for test
function startTest()
{
    x  = setInterval(test, 900);
}

// To submit the test when time is up
function submitTest()
{
    localStorage.removeItem('oldSecond');
    localStorage.removeItem('oldMinute');
    clearInterval(x);
    window.location.href="../php/result.php";
}

//To reduce the timer value every second
function test() 
{
    if(localStorage.getItem('oldSecond') == null)
    {
        // Setting the timer value for the first time
        var oldtime = new Date().getTime();
        localStorage.setItem('oldSecond', oldtime);
        localStorage.setItem('oldMinute', '29');
        document.getElementById('timer').innerHTML = "30 : 00";
        return;
    }
    var nowtime = new Date().getTime();
    var second = 60 - Math.ceil((nowtime - localStorage.getItem('oldSecond')) / 1000);
    var minute = Math.ceil(localStorage.getItem('oldMinute'));
    if(second < 10 && second >= 0)
    {
        second = '0' + second;
    }
    if(minute < 10 && minute >= 0)
    {
        minute = '0' + minute;
    }
    document.getElementById('timer').innerHTML = minute + " : " + second;
    minute = Math.ceil(minute);
    second = Math.ceil(second);
    if(minute < 0)
    {
        alert('Your answers are saved and submitted');
        submitTest();
    }
    if(second <= 0)
    {
        localStorage.setItem('oldSecond', nowtime);
        localStorage.setItem('oldMinute', minute - 1);
    }
}

// To randomize the question pattern
function shuffleQuestions()
{
    len = data.length;
    flag = [];
    for(let i = 0; i < len; i++)
    {
        flag[i] = false;
    }
    // selecting question to display during test
    for(let i = 0; i < 30; i++)
    {
        var itr = 0;
        var rand = (Math.round((Math.random()*len*10)) % len);
        if(!flag[rand])
        {
            flag[rand] = true;
            localStorage.setItem('Ques' + i, rand);
        }
        else
        {
            for(let j = 0; j < len; j++)
            {
                if(!flag[j])
                {
                    flag[j] = true;
                    localStorage.setItem('Ques' + i, j);
                    break;
                }
            }
        }
    }
}

// To display the next question
function loadnext()
{
    index = localStorage.getItem('index');
    index++;

    // Validation
    if(index < 0)
    {
        index = 0;
    }
    if(index >= 30)
    {
        window.location.href = "../php/result.php";
    }

    // Fetching the question and Setting all option to false
    var option = document.getElementsByClassName('option');
    var ans = document.getElementsByName('ans');
    if(option == null || ans == null)
    {
        alert('An Error Occurred');
        return;
    }

    var itr = localStorage.getItem('Ques' + index);
    document.getElementById('que').innerHTML = (index + 1) + ") " +data[itr][1];
    
    option[0].innerHTML = data[itr][2];
    option[1].innerHTML = data[itr][3];
    option[2].innerHTML = data[itr][4];
    option[3].innerHTML = data[itr][5];
    
    ans[0].checked = false;
    ans[1].checked = false;
    ans[2].checked = false;
    ans[3].checked = false;

    // Setting value of a particular option to true if already answered
    if(localStorage.getItem('Ans'+index))
    {
        var pos = localStorage.getItem('Ans'+index);
        if(pos > 0 && pos < 5)
        {
            ans[pos-1].checked = true;
        }
    }

    // Changing button values to appropriate functionality
    var next = document.getElementById('next');
    var prev = document.getElementById('previous');
    if(prev == null || next == null)
    {
        return;
    }
    if(index == 0)
    {
        prev.disabled = true;
        next.value = "Next";
        prev.style.backgroundImage = "linear-gradient(to right, #335818, #0b630b)";
    }
    else if(index >= 29)
    {
        next.value = "Submit";
    }
    else
    {
        prev.disabled = false;
        next.value = "Next";
        prev.style.backgroundImage = "linear-gradient(to right, yellow, green)";
    }
    // Storing the current index value      
    localStorage.setItem('index', index);

    // Updating question color
    var question = document.getElementsByClassName('numbers');
    if(question != null)
    {
        if(question[index].style.backgroundColor != 'red')
        {
            document.getElementById('flag').value = 'Flag';
        }
        else
        {
            document.getElementById('flag').value = 'Unflag';
        }
    }
}

// To display the previous question
function loadprev()
{
    index = localStorage.getItem('index');
    index -= 2;
    if(index < -1)
    {
        index = 0;
        return;
    }
    localStorage.setItem('index', index);
    loadnext();
}

// To save the answer
function saveAns()
{
    var ans = document.getElementsByName('ans');
    if(ans == null)
    {
        alert('An Error Occurred');
        return;
    }
    if(index >= 0)
    {
        var itr = localStorage.getItem('Ques' + index);
        var orgAns = data[itr][6];
        localStorage.setItem('orgAns'+index, orgAns);
    }
    if(!localStorage.getItem('Ans'+index))
    {
        localStorage.setItem('Ans'+index, 0);
    }

    // Storing the answer for later calculation
    var itr = 0;
    while(itr < ans.length)
    {
        var status = ans[itr].checked;
        if(status)
        {
            localStorage.setItem('Ans'+index, ans[itr].value);
        }
        itr++;
    }

    // Updating question color
    var question = document.getElementsByClassName('numbers');
    if(question != null)
    {
        if(localStorage.getItem('color'+index) != 'red')
        {
            question[index].style.backgroundColor = 'green';
            localStorage.setItem('color'+index,'green');
        }
    }
}

// To clear a selection of answer
function clearAns()
{
    var ans = document.getElementsByName('ans');
    if(ans == null)
    {
        alert('An Error Occurred');
        return;
    }

    // Setting all option values to false
    ans[0].checked = false;
    ans[1].checked = false;
    ans[2].checked = false;
    ans[3].checked = false;
    
    // Clearing the stored answer value
    localStorage.setItem('Ans'+index, 0);

    // Updating question color
    var question = document.getElementsByClassName('numbers');
    if(question != null)
    {
        if(localStorage.getItem('color'+index) != 'red')
        {
            question[index].style.backgroundColor = 'whitesmoke';
            localStorage.setItem('color'+index,'whitesmoke');
        }
    }
}

// To load a particular question defined by QNumber
function loadQuestionNo(QNumber)
{
    if(QNumber <= 0 && QNumber >= 30)
    {
        return;
    }
    localStorage.setItem('index', QNumber - 2);
    loadnext();
}

// To color all question label that has been Attempted or Flaged
function colorAll()
{
    var questions = document.getElementsByClassName('numbers');
    if(questions == null)
    {
        return;
    }

    // Updating questions with appropriate questions
    var itr = 0;
    while(itr < 30)
    {
        if(localStorage.getItem('color'+itr))
        {
            questions[itr].style.backgroundColor = String(localStorage.getItem('color'+itr));
        }
        itr += 1;
    }
}

// To Flag a particular question
function setFlag()
{
    var question = document.getElementsByClassName('numbers');
    var text = document.getElementById('flag');
    if(question != null)
    {
        if(question[index].style.backgroundColor != 'red')
        {
            // If the question is not Flaged
            question[index].style.backgroundColor = 'red';
            text.value = 'Unflag';
            localStorage.setItem('color'+index, 'red');
        }
        else if(localStorage.getItem('Ans'+index) != null && localStorage.getItem('Ans'+index) != 0)
        {
            // If the question is already Flaged and answer is known. 
            question[index].style.backgroundColor = 'green';
            text.value = 'Flag';
            localStorage.setItem('color'+index, 'green');
        }
        else 
        {
            // If the question is already Flaged but not yet answered
            question[index].style.backgroundColor = 'whitesmoke';
            text.value = 'Flag';
            localStorage.setItem('color'+index, 'whitesmoke');
        }
    }
}

// To preview the result
function preview()
{
    var obj = document.getElementById('view');
    // If the object not found
    if(obj == null)
    {
        alert("Can not display preview for questions.");
        return;
    }

    // Toggle action for preview questions
    if(obj.style.display != 'block')
    {
        obj.style.display = "block";
    }
    else
    {
        obj.style.display = "none";
    }
}

// To load the questions for preview
function loadQuestions(idx)
{
    // Validation
    if(idx < 0 || idx > 30)
    {
        return;
    }

    // Displaying questions
    var itr = localStorage.getItem('Ques' + idx);
    question = "<pre class='que'>" + Number((idx) + 1) + ") " + data[itr][1] + "</pre>";
    opt1 = "<input type='radio' name='ans" + idx + "' disabled > <label class='normal lb" + idx + "'>" + data[itr][2] + "</label><br>";
    opt2 = "<input type='radio' name='ans" + idx + "' disabled > <label class='normal lb" + idx + "'>" + data[itr][3] + "</label><br>";
    opt3 = "<input type='radio' name='ans" + idx + "' disabled > <label class='normal lb" + idx + "'>" + data[itr][4] + "</label><br>";
    opt4 = "<input type='radio' name='ans" + idx + "' disabled > <label class='normal lb" + idx + "'>" + data[itr][5] + "</label><br>";
    document.write("<div>");
    document.write(question);
    document.write(opt1);
    document.write(opt2);
    document.write(opt3);
    document.write(opt4);
    document.write("<br><br><br>");
    document.write("</div>");

    var ans = document.getElementsByName('ans' + idx);
    var label = document.getElementsByClassName('lb' + idx);
    if(ans == null || label == null)
    {
        return;
    }
    // Checking for correct answer and updating colors
    if(localStorage.getItem('Ans'+idx))
    {
        var pos = Number(localStorage.getItem('Ans'+idx)) - 1;
        if(pos >= 0 && pos <= 3)
        {
            ans[pos].disabled = false;
            ans[pos].checked = true;
            label[pos].style.fontWeight = "600";
            if((pos + 1) == data[itr][6])
            {
                label[pos].style.color = "14e02d";
            }
            else
            {
                label[pos].style.color = "#e21212";
            }
        }
    }
}