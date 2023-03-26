import React, { Component } from 'react';
import { Link } from 'react-router-dom';

class Tester extends Component {
		perfectState = {};
    state = {};

		flipCorrectness(ans){
			// console.log(ans);
			for (const q of this.state.questions){
				for(let a of q.answers){
					if(a.id == ans.id){
						// console.log('found',a.id);
						a.isCorrect = !a.isCorrect;
					}
				}
			}
		}

		calculateResult = () => {
			let nofQuestions = 0;
			let nofCorrectOnes = 0;
			for (let i=0; i<this.state.questions.length; i++){
				nofQuestions++;
				nofCorrectOnes++;
				for(let j=0; j<this.state.questions[i].answers.length; j++){
					if(this.state.questions[i].answers[j].isCorrect != this.perfectState.questions[i].answers[j].isCorrect){
						nofCorrectOnes--;
						break;
					}
				}
			}
			let result = document.getElementById('result');
			result.innerText = "your result is " + Math.floor((nofCorrectOnes/nofQuestions)*20) + "/20";
			console.log('perfectState',this.perfectState);
			console.log('yourState',this.state);

		}

    render() { 
		if(localStorage.getItem('state') == null){
			return(
				<div>
				<h1 align='center' style = {{color:'red',fontWeight:'bold'}}>Create the test first</h1>
				<h1 align ='center'>
				<Link to='/TestCreator'>
				<button className='btn btn-primary'>Create</button>
				</Link>
				</h1>
				</div>
			)
		}
		this.state = JSON.parse(localStorage.getItem('state'));
		this.perfectState = JSON.parse(localStorage.getItem('state'));
        return (
					<div>
						<ol>
						{
							this.state.questions.map(q => 
								<li key={this.state.questions.indexOf(q)+1000}>
									<h3>{q.text}?</h3>
									<ul key={this.state.questions.indexOf(q)}>
										{q.answers.map( a  =>
											<li className="form-check" key={q.answers.indexOf(a)}>
												{a.isCorrect = false}
												<input type="checkbox" className="m-2" onChange={() => this.flipCorrectness(a)} />
												<label>{a.text}</label>
											</li>
										)
										}
									</ul>
								</li>
							)
						}
						</ol>
						<br />
						<button onClick={this.calculateResult} className='btn btn-success m-2	'>Finish</button>
						<h1 className='w-50 mx-auto text-primary bg-dark fixed-bottom' id='result' align='center'></h1>
					</div>
				);
    }
}
 
export default Tester;
