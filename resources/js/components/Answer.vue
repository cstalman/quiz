<template>
    <div class="container">
        <h2 class="my-4">Antwoord bewerken</h2>
        <form class="answer-form" @submit.prevent="save">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="question">Vraag</label>
                    <select id="question" class="form-control" v-model="answer.question_id" required>
                        <option value="">Kies een vraag</option>
                        <option v-for="question in questions" :value="question.id" :key="question.id">{{question.text}}</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="answer_text">Antwoord</label>
                    <input type="text" class="form-control" id="answer_text" v-model="answer.text" required>
                </div>
                <div class="form-group col-md-1">
                    <label for="answer_score">Score</label>
                    <input type="number" class="form-control" id="answer_score" min="1" v-model="answer.score" required>
                </div>
                <div class="form-group col-md-1">
                    <label for="answer_correct">Correct</label>
                    <input type="checkbox" class="form-control" id="answer_correct" v-model="answer.correct">
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
        props: ['initial-questions', 'id'],
        data() {
            return {
                questions: _.cloneDeep(this.initialQuestions), 
                answer: newAnswer(),
                errors: []
            };
        },
        created() {
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
            save() {
                let url = '/api/answers/add';
                if (this.id) {
                    url = '/api/answers/' + this.id;
                }
                axios.post(url, this.answer)
                    .then(res => {
                        this.$router.push('/');
                    })
                    .catch(error => {
                        let messages = Object.values(error.response.data.errors);
                        this.errors = [].concat.apply([], messages);
                    });
            }
        }
    }
</script>