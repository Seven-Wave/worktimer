<template>
    <div style="width: 100%; height: 100vh; display: flex; flex-direction: column; justify-content: center; align-items: center" id="chronoExample">
        <a style="position: absolute; top: 20px; right: 20px" href="/logout">Выйти</a>
        <div style="max-width: 400px;">
            <div style="width: 100%; display: flex; flex-direction: row; justify-content: space-between">
                <div style="display: flex; flex-direction: column">
                    <span style="text-align: center">Рабочее время:</span>
                    <div style="font-size: 30px" class="values">00:00:00</div>
                </div>
                <div style="display: flex; flex-direction: column">
                    <span style="text-align: center">Перерыв:</span>
                    <div style="font-size: 30px; color: red" class="values2">00:00:00</div>
                </div>
            </div>
            <div style="border-bottom: 2px solid white; margin: 7px 0 7px 0;"></div>
            <div>
                <button v-on:click="start" class="startButton btn btn-success">Начать</button>
                <button v-on:click="pause" class="pauseButton btn btn-light" disabled>Перерыв</button>
                <button v-on:click="stop" class="stopButton btn btn-light" disabled>Закончить рабочий день</button>
            </div>

        </div>
        <br>
        <br>
        <div id="userInfoTable" style="color: white; border-radius: 10px; padding: 10px 10px; position: relative; overflow: hidden">
            <div style="position: absolute; z-index: 0; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.7; background-color: #032192; filter: blur(55px);"></div>

            <div style="position:relative; z-index: 20;">
                <h4 style="text-align: center">Затрачено времени на сегодня:</h4>
                <br>
                <table style="min-width: 500px">
                    <thead>
                    <tr>
                        <th>Начало работы</th>
                        <th>Конец работы</th>
                        <th>Рабочее время</th>
                        <th>Перерыв</th>
                    </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>{{ this.info.start }}</td>
                            <td>{{ this.info.finish }}</td>
                            <td>{{ this.info.work }}</td>
                            <td>{{ this.info.pause }}</td>

                        </tr>

                    </tbody>
                </table>
            </div>

        </div>

    </div>
</template>

<script>
export default {
    data: function () {
        return {
            info: {
                start: '',
                finish: '',
                work: '',
                pause: ''
            },
            worktime_start: '',
            pause_time_start: '',
            pause_time_end: '',
            pause_starts: false,
        }
    },
    methods: {
        start() {
            let pauseButton = document.querySelector(".pauseButton")
            let stopButton = document.querySelector(".stopButton")
            pauseButton.disabled = false
            stopButton.disabled = false
            timer.start();

            this.worktime_start = moment().format('HH:mm:ss')

            if (this.pause_starts) {
                pauseTimer.pause()
                this.pause_time_end = moment().format('HH:mm:ss')
                axios.post('/timer/pause/create', {
                    time_start: moment().format('YYYY-MM-DD') + ' ' + this.pause_time_start,
                    time_end: moment().format('YYYY-MM-DD') + ' ' + this.pause_time_end,

                }).then(res => {
                    // Swal.fire('Test', res.data.message, 'success')

                })
                this.pause_starts = false
            }

        },
        pause() {
            timer.pause();
            pauseTimer.start()
            this.pause_time_start = moment().format('HH:mm:ss')
            this.pause_starts = true

        },
        stop() {
            Swal.fire({
                title: 'Уверены что хотите завершить рабочий день?',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'Да!',
                denyButtonText: `Нет`,
            }).then((result) => {
                if (result.isConfirmed) {
                    let pauseButton = document.querySelector(".pauseButton")
                    let stopButton = document.querySelector(".stopButton")

                    stopButton.disabled = true

                    pauseButton.disabled = true
                    let worktime = timer.getTimeValues().toString()
                    let obj = this
                    timer.stop();
                    pauseTimer.stop()
                    $('#chronoExample .values').html('00:00:00');
                    $('#chronoExample .values2').html('00:00:00');

                    if (this.pause_starts) {

                        this.pause_time_end = moment().format('HH:mm:ss')
                        axios.post('/timer/pause/create', {
                            time_start: moment().format('YYYY-MM-DD') + ' ' + this.pause_time_start,
                            time_end: moment().format('YYYY-MM-DD') + ' ' + this.pause_time_end,

                        })

                        this.pause_starts = false
                    }

                    axios.post('/timer/worktime/create', {
                        worktime: moment().format('YYYY-MM-DD') + ' ' + worktime,
                        worktime_start: moment().format('YYYY-MM-DD') + ' ' +  obj.worktime_start
                    }).then(res => {
                        if (res.data.status == 'ok') {
                            Swal.fire('Отличная работа!', res.data.message, 'success')
                            // показать сколько отработал сегодня
                            axios.post('/timer/get_status')
                                .then(res => {
                                    if (res.data.status == 'ok') {
                                        let infoEl = document.getElementById('userInfoTable')
                                        infoEl.style.display = 'block'
                                        this.info.start = res.data.start
                                        this.info.finish = res.data.finish
                                        this.info.work = res.data.worktime
                                        this.info.pause = res.data.pauses

                                    }
                                })
                        }
                    })

                }
            })


        }
    },
    mounted() {
        timer.addEventListener('secondsUpdated', function (e) {
            $('#chronoExample .values').html(timer.getTimeValues().toString());
        });

        timer.addEventListener('started', function (e) {
            $('#chronoExample .values').html(timer.getTimeValues().toString());
        });

        timer.addEventListener('reset', function (e) {
            $('#chronoExample .values').html(timer.getTimeValues().toString());
        });

        pauseTimer.addEventListener('secondsUpdated', function (e) {
            $('#chronoExample .values2').html(pauseTimer.getTimeValues().toString());
        });

        pauseTimer.addEventListener('started', function (e) {
            $('#chronoExample .values2').html(pauseTimer.getTimeValues().toString());
        });

        pauseTimer.addEventListener('reset', function (e) {
            $('#chronoExample .values2').html(pauseTimer.getTimeValues().toString());
        });
    }
};
</script>

<style>
    #chronoExample {
        background-color: #f9c5d1;
        background-image: linear-gradient(315deg, #f9c5d1 0%, #9795ef 74%);
    }

    #userInfoTable {
        display: none;
    }
</style>
