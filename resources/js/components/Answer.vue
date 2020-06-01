<template>
    <div class="container">
        <h2 class="my-4">Antwoord bewerken</h2>
        <form class="answer-form" @submit.prevent="save">
            <div class="form-row">
                 <div v-if="this.id">
                </div>
                <div v-else class="form-group col-md-2">
                    <label for="quiz">Toets</label>
                    <select id="quiz" class="form-control" v-model="quizId" @change="fetchQuestions" required>
                        <option v-for="quiz in quizzes" :value="quiz.id" :key="quiz.id">{{quiz.title}}</option>
                    </select>
                </div>
                 <div v-if="this.id">
                </div>
                <div v-else class="form-group col-md-3">
                    <label for="question">Vraag</label>
                    <select id="question" class="form-control" v-model="answer.question_id" required>
                        <option value="">Kies een vraag</option>
                        <option v-for="question in questions" :value="question.id" :key="question.id">{{question.text}}</option>
                    </select>
                </div>
                <div class="form-group col-md-5">
                    <label for="answer_text">Antwoord</label>
                    <input type="text" class="form-control" id="answer_text" v-model="answer.text" required>
                </div>
                <div class="form-group col-md-1">
                    <label for="answer_score">Score</label>
                    <input type="number" class="form-control" id="answer_score" min="1" v-model="answer.score" required>
                </div>
                <div class="form-group col-md-1">
                    <label for="answer_correct">Correct</label>
                    <input type="checkbox" class="form-control" id="answer_correct" value=1 v-model="answer.correct">
                </div>
                
            </div>      
            <button type="submit" class="btn btn-primary d-inline-block mb-2 text-white"><i class="fa fa-check-circle"></i> Opslaan</button>
            <ul>
                <li v-for="(error, index) in errors" :key="index">{{error}}</li>
            </ul>
        </form>
    </div>
</template>

<script>

    function newAnswer() {
        return {
            question_id: '',
            text: '',
            score: '',
            correct: ''
        };
    }

    export default {
        props: ['initialQuizzes', 'initialQuestions', 'id'],
        data() {
            return {
                answer: newAnswer(),
                errors: [],
                quizId: '',
                questionId: this.initialQuestions[0].id,
                quizzes: [],
                questions: [], 
                answers: []
            };
        },
        created() {
            this.fetchQuizzes();
            this.fetchQuestions();
            if(this.id) {
                axios.get('/api/answers/' + this.id)
                    .then(res => this.answer = res.data);
            }
        },
        beforeRouteLeave(to, from, next) {
            this.answer = newAnswer();
            next();
        },
        methods: {
            fetchQuizzes() {
                axios.get('/api/quizzes')
                    .then(res => this.quizzes = res.data);
            },
            fetchQuestions() {
                axios.get(`/api/quizzes/${this.quizId}/questions`)
                    .then(res => this.questions = res.data);
            },
            save() {
                let url = '/api/answers/add';
                if (this.id) {
                    url = '/api/answers/' + this.id;
                }
                axios.post(url, this.answer)
                    .then(res => {
                        this.$router.push('/answers');
                    })
                    .catch(error => {
                        let messages = Object.values(error.response.data.errors);
                        this.errors = [].concat.apply([], messages);
                    });
            }
        }
    }
</script>