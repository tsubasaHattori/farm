<style>
.day-change-block {
    text-align: center;
    margin-top: 35px;
}

.day-change {
    display: inline-block;
    width: 100px;
    font-size: 12px;
    border-radius: 8px;
    background: #8EB8FF;
    box-shadow: 0px 0px 0px 5px #8EB8FF;
}

.write {
    font-size: 25px;
}

.message {
    margin-top: 30px;
}

.my-message {
    text-align: right;
}

.writer .fa{
    margin-right: 10px;
}

.time {
    font-size: 12px;
    opacity: 0.6;
}

.fa-trash {
    cursor: pointer;
    color: #CC3333;
}

.my-message .content-line {
    width: 70%;
    text-align: right;
    margin: 1em 0 1em auto;
}

.my-message .content-box {
    background: #66FF99;
    box-shadow: 0px 0px 0px 9px #66FF99;
    text-align: left;
}

.others-message .content-line {
    width: 70%;
    margin: 1em 0 1em 0;
}

.others-message .content-box {
    background: #ffeaea;
    box-shadow: 0px 0px 0px 9px #ffeaea;
}

.content-box, .content-box-null {
    color: #565656;
    display: inline-block;
    margin-left: 10px;
    border-radius: 8px;
}

.content-box-null {
    background: #DDDDDD;
    box-shadow: 0px 0px 0px 9px #DDDDDD;
}

.content {
    white-space: pre-wrap;
}

.store-form {
    width: 500px;
}

@media screen and (max-width: 560px) {
    .store-form {
        width: 90%;
    }
}

@media screen and (max-width: 960px) {
    store-form {
        width: 80%;
    }
}

textarea {
    font-size: 16px;
}

.btn-square-shadow {
    display: inline-block;
    padding: 0.5em 1em;
    text-decoration: none;
    background: #fd9535;/*ボタン色*/
    color: #FFF;
    border-bottom: solid 4px #627295;
    border-radius: 3px;
}
.btn-square-shadow:active {
    /*ボタンを押したとき*/
    -webkit-transform: translateY(4px);
    transform: translateY(4px);/*下に動く*/
    box-shadow: 0px 0px 1px rgba(0, 0, 0, 0.2);/*影を小さく*/
    border-bottom: none;
}
</style>

<template>
<div>
    <div v-for="(message, index) in messages" :key="index" class="messages-block">
        <form name="deleteForm" action="/home/delete/message.id" method="POST">
            <!-- @if ($index == 0)
            <div v-if="index == 0" class="day-change-block">
                <span class="day-change">{{ $message['created_at']->format('n/d (D)') }}</span>
            </div>
            @elseif ($index-1 >= 0 && $message['created_at']->day - $messages[$index-1]['created_at']->day)
            <div class="day-change-block">
                <span class="day-change">{{ $message['created_at']->format('n/d (D)') }}</span>
            </div>
            @endif -->
            <div class="message" :class='[message.user_id == authUser.id ? "my-message" : "others-message"]'>
                <div class="upper-line">
                    <span class="writer">
                    <i v-if="!message.is_deleted && message.user_id == authUser.id" id="trash" class="fa fa-trash fa-lg" @click="deleteMessage('deleteForm', '/home/delete/{{ message.id }}', 'POST')"></i>
                    {{ users[message.user_id].name }}
                    </span>
                </div>
                <div class="middle-line">
                    <span class="time">{{ message.created_at | moment }}</span>
                </div>
                <div class="content-line">
                    <div v-if="message.is_deleted">
                        <span class="content-box-null">
                            <span class="content">メッセージが削除されました</span>
                        </span>
                    </div>
                    <div v-else>
                        <span class="content-box">
                            <span class="content">{{ message['content'] }}</span>
                        </span>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="message-form">
        <hr width = "100%"><center>
        <p class="write" @click="scrollEnd">書き込み</p>
        <div class="store-form">
            内容<br>
            <textarea v-model="content" name="content" style="width: 100%; height: 80px;" required></textarea><br>
            <input @click="storeMessages" class="btn btn-square-shadow" type="submit" value="投稿" :disabled="isPosting || !content">
        </div>
        <hr width = "100%"></center>
    </div>
</div>
</template>

<script>
    export default {
        delimiters: ['${','}'],
        props: [
            'authUser',
            'users',
        ],
        data: function () {
            return {
                content: "",
                isPosting: false,
                messages: [],
            }
        },
        mounted: function() {
            this.$nextTick(function () {
                // ビュー全体がレンダリングされた後にのみ実行されるコード
                this.scrollEnd();
            });

            this.getMessages();

            setInterval(this.getMessages, 5000);
        },
        methods: {
            getMessages: function() { //←axios.getでデータを取得
                var url = 'api/home/get-messages';
                axios.get(url)
                .then((res)=>{
                    this.messages = res.data; //取得したデータをitemsに格納
                })
                .catch(error => console.log(error))
            },

            storeMessages: function() {
                this.isPosting = true;

                var url = 'api/home/store-messages';
                axios.post(url, {
                    id : this.authUser.id,
                    content : this.content,
                })
                .then((res)=>{
                    this.isPosting = false;
                    this.content = "";
                    this.getMessages();
                    this.scrollEnd();
                })
                .catch(error => console.log(error))
            },

            scrollEnd: function() {
                var elementHtml = document.documentElement;
                var bottom = elementHtml.scrollHeight - elementHtml.clientHeight;
                window.scrollTo(0, bottom);
            },
        },
        filters: {
            moment: function (date) {
                return moment(date).format("HH:mm");// eslint-disable-line
            }
        }
    }
</script>
