const question =[
    {
        'que': 'How often do you feel overwhelmed by schoolwork?',
        'A': 'Rarely', //1pt
        'B': 'Occasionally', //2pt
        'C': 'Frequently', //3pt
        'D': "Constantly" //4pt
    },
    {
        'que': 'How often do you find it difficult to concentrate on your studies due to stress?',
        'A': 'Never', // 1 point
        'B': 'Sometimes', // 2 points
        'C': 'Often', // 3 points
        'D': 'All the time', // 4 points
    },
    {
        'que': 'Do you struggle to maintain a healthy sleep schedule because of schoolwork?',
        'A': 'Never', // 1 point
        'B': 'A few times a month', // 2 points
        'C': 'Once a week', // 3 points
        'D': 'Daily', // 4 points
    },
    {
        'que': 'How often do you feel anxious or worried about deadlines or exams?',
        'A': 'Not at all', // 1 point
        'B': 'A little anxious', // 2 points
        'C': 'Moderately anxious', // 3 points
        'D': 'Severely anxious', // 4 points
    },
    {
        'que': 'Do you feel like you are neglecting hobbies or activities you enjoy due to studying?',
        'A': 'Never', // 1 point
        'B': 'A few times a month', // 2 points
        'C': 'Once a week', // 3 points
        'D': 'Daily', // 4 points
    },
    {
        'que': 'How often do you experience physical symptoms like headaches or stomachaches due to stress?',
        'A': 'Never', // 1 point
        'B': 'A few times a month', // 2 points
        'C': 'Once a week', // 3 points
        'D': 'Daily', // 4 points
    },
    {
        'que': 'Do you feel confident in your ability to manage your workload effectively?',
        'A': 'Very confident', // 1 point
        'B': 'Somewhat confident', // 2 points
        'C': 'Neutral', // 3 points
        'D': 'Not very confident', // 4 points
    },
    {
        'que': 'How often do you consider seeking help from a tutor, counselor, or advisor?',
        'A': 'Never', // 4 points (reluctant to seek help)
        'B': 'A few times a semester', // 3 points
        'C': 'Once a semester', // 2 points
        'D': 'Whenever I need it', // 1 point (proactive help-seeking)
    },
    {
        'que': 'Do you feel like you are learning and retaining information effectively in your classes?',
        'A': 'Yes, most of the time', // 1 point
        'B': 'Sometimes', // 2 points
        'C': 'Not as much as I would like', // 3 points
        'D': 'No, I am struggling to understand the material', // 4 points
    },
    {
        'que': 'Overall, how satisfied are you with your current academic experience?',
        'A': 'Very satisfied', // 1 point
        'B': 'Somewhat satisfied', // 2 points
        'C': 'Neutral', // 3 points
        'D': 'Dissatisfied', // 4 points
    }

]
let index = 0;
let total= question.length;
let score=0 ;
const quesBox = document.getElementById("quesBox")

const optionInputs = document.querySelectorAll('.options')

const loadQuestion = () => {
    if(index == total){
        return endQuiz();
    }
    else{
        reset();
        const data = question[index]
        quesBox.innerText = `${index+1}. ${data.que}`;
        optionInputs[0].nextElementSibling.innerText = data.A;
        optionInputs[1].nextElementSibling.innerText = data.B;
        optionInputs[2].nextElementSibling.innerText = data.C;
        optionInputs[3].nextElementSibling.innerText = data.D;

    }
    
}
const submitQuiz = () => {
    const data = question[index]
    const ans = getAnswer()
    if(ans === '0'){
        alert("Please select any of the following option!");
    }
    else if(ans === 'A'){
        score+=1;
        index++;
    }
    else if(ans === 'B'){
        score+=2;
        index++;
    }
    else if(ans === 'C'){
        score+=3;
        index++;
    }
    else if(ans === 'D'){
        score+=4;
        index++;
    }
    loadQuestion();
    
    
    
}

const getAnswer = () => {
    let Answer ='0';
    optionInputs.forEach(
        (input) => {
            if (input.checked){
                Answer = input.value;   
            }    
        }
    )
    return Answer;
}

const reset = () => {
    optionInputs.forEach(
        (input) =>{
            input.checked = false;
        }
    )
}

const endQuiz = () => {
    if(score>= 10 && score<=16){
        document.getElementById('box').innerHTML = `
        <h2>NO-Stress</h2>  
        <p>You don't seem to be experiencing high levels of stress. Keep up the good work! Remember, mental health is important for everyone, so check in with friends and family.</p>
        `
    }
    else if(score>=17 && score<=24){
        document.getElementById('box').innerHTML = `
        <h2>Moderate-Stress</h2>  
        <p>You might be experiencing some stress. Techniques like meditation and talking to loved ones can be helpful. Don't hesitate to seek professional help if needed.</p>
        `
    }
    else if(score>=25 && score<=32){
        document.getElementById('box').innerHTML = `
        <h2>High-Stress</h2>  
        <p>Your responses indicate significant stress. Prioritize self-care and consider seeking professional support. There are resources available to help you manage stress effectively.</p>`
    }
    else if(score>=33 && score<=40){
        document.getElementById('box').innerHTML = `
        <h2>Very High Stress</h2>  
        <p>Your responses suggest high levels of stress that could be impacting your well-being. It's crucial to seek professional help. Remember, you're not alone in this.</p>
        `
    }
    
    
}

loadQuestion();
