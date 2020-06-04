<template>
    <div class="container">
        <h2 class="my-4">Vragen toets {{ quiz.title }}</h2>
        <div v-if="preview" class="alert alert-warning" role="alert">
            Dit is een preview: de antwoorden worden niet opgeslagen!
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="alert alert-primary fade show my-4" v-show="feedback">
                    {{ feedback }}
                    <button type="button" class="close" data-hide="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card mt-3" v-for="(question) in questions" :key="question.id">
                    <div class="card-header">{{  question.text }} </div>
                    <div class="card-body">
                        <p v-for="(answer) in question.answers" :key="answer.id">
                            <input type="radio" :id="'a_' + answer.id" :name="'answer_' + question.id" :value="answer.id" v-model="answer_id" v-on:change="saveAnswer()">
                            <label :for="'a_' + answer.id">{{ answer.text }}</label>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="alert alert-primary fade show my-4" v-show="feedback">
                    {{ feedback }}
                    <button type="button" class="close" data-hide="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div v-if="preview" class="my-4">
                    <a href="/" class="btn btn-primary d-inline-block mb-2 ml-2 text-white remove"><i class="fa fa-bars"></i> Terug naar de Editor</a>
                </div>
                <div v-else class="my-4">
                    <router-link :to="{name: 'quizzes'}">
                        <a class="btn btn-primary d-inline-block mb-2 ml-2 text-white remove"><i class="fa fa-bars"></i> Inleveren en terug naar toetsen</a>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    $(function(){
        $("[data-hide]").on("click", function(){
            $(this).closest("." + $(this).attr("data-hide")).hide();
        });
    });
    
    export default {
        props: ['initialQuizzes', 'id'],
        data() {
            return {
                quizId: this.initialQuizzes[0].id,
                quiz: '',
                questions: [],
                answers : [],
                feedback: '',
                preview: true
            }
        },
        created() {
            this.fetchQuiz();
            this.fetchQuizQa();
            this.setPreview();
        },
        methods: {
            setPreview() {
                if (this.$route.path.includes('preview')) {
                    this.preview = true;
                } else  {
                    this.preview = false;
                }
            },
            fetchQuiz() {
                axios.get('/api/quizzes/' + this.$route.params.id + '/')
                    .then(res => this.quiz = res.data);
            },
            fetchQuizQa() {
                axios.get('/api/quizzes/' + this.$route.params.id + '/qa')
                    .then(res => this.questions = res.data);
            },
            saveAnswer() {
                if(this.preview) {
                    return;
                }
                axios.post('/api/questionnaire/insup/', {
                    answer: this.answer_id, 
                    question: this.question_id
                })
                .then((res) => {
                    if (res.data.success) {
                        this.feedback = 'De wijzigingen zijn opgeslagen';
                        $(".alert").show();
                    }     
                });
            },
        }
    }
</script>