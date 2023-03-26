import "bootstrap/dist/css/bootstrap.css";
import React ,{ Component } from "react";
import { Link } from "react-router-dom";

class Answer{
	id;
	isCorrect = false;
	text = "";
	constructor (id, txt){
		this.id = id;
		this.text = txt;
	};
}

class Question {
	answers = [];
	text = "";

	addAnswer(id, txt){
		this.answers.push(new Answer(id, txt));
	}

	constructor(txt){
		this.text = txt;
	}
};

class TestCreator extends Component{

	id = 0;
	
	state = {
		questions : []
	};
	
	renderTextFields = () => {
		console.log("clicked");
		const txt = document.getElementById("txt").value;
		this.state.questions.push(new Question(txt))
		this.setState({questions :this.state.questions});
	}

	addAnswer(index){
		const text  = document.getElementById(index+100).value;
		this.state.questions[index].addAnswer(this.id++, text);
		this.setState({questions : this.state.questions});
	}

	storeQuestions = () => {
		localStorage.setItem('state',JSON.stringify(this.state));
	}

	setAswerSelected = (answer ) => {
		answer.isCorrect = !answer.isCorrect;
	}

	render(){
		console.log(this.state);
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
									<input type="checkbox" className="m-2" onChange={() => this.setAswerSelected(a)}/>
									<label>{a.text}</label>
								</li>
							)
							}
							<li key={this.state.questions.indexOf(q)+200}>
								<input id={this.state.questions.indexOf(q)+100} />
								<button onClick = {() => this.addAnswer(this.state.questions.indexOf(q))}>add answer</button>
								</li>	
						</ul>
					</li>
				)
			}
			</ol>
			<br />
			<input type ="text" size="20" id="txt" className="m-2"/>
			<button onClick = {this.renderTextFields} >Add Question</button><br />
			<Link to = '/'><button onClick={this.storeQuestions} className = 'btn btn-danger m-2 '>Submit</button></Link>
			</div>
		);
	}
}

export default TestCreator;