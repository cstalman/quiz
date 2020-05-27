<template>
    <div class="container">
        <h2 class="my-4">Overzicht toetsen</h2>
        <div class="row justify-content-center">
            <div class="col-sm-6">
                    <div class="card mt-3" v-for="(quiz, index) in quizzes" :key="quiz.id">
                        <div class="card-header">{{ quiz.title }}</div>

                        <div class="card-body">
                            <p>{{ quiz.description }}</p>
                            <a @click="takeQuiz(index)" class="btn btn-primary d-inline-block mb-2 ml-2 text-white remove"><i class="fa fa-edit"></i> Toets maken</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props: ['initialQuizzes'],
        data() {
            return {
                quizzes: _.cloneDeep(this.initialQuizzes), 
                feedback: ''
            }
        },
           
    }
</script>

<style scoped>
    input {
        margin-right: 10px;
    }
    
    hr {
        margin-bottom: 10px;
        max-width: 1140px;
    }

    @media (max-width: 632px) {
        input{
            margin-bottom: 10px;
        }
    }

</style>