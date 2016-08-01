/**
 * Created by Weapon on 2016/4/28.
 */
function timeFormatter(formatTime) {
    return formatTime.getFullYear() + "/" + (formatTime.getMonth()+1) + "/" + formatTime.getDate() + " "
        + formatTime.getHours() + ":" + formatTime.getMinutes() + ":" + formatTime.getSeconds();
}