<style>
.node-modal { position: absolute; z-index : 9997; top:0; bottom:0; left:0; right:0; visibility: hidden; opacity: 0; transition: all .5s; }
.node-modal .node-bg { position: absolute; z-index: 9998; background-color: rgba(0,0,0,.5); width: 100%; height: 100%;}
.node-modal .node-modal-content { position: absolute; z-index: 9999; left:0; right:0; bottom: 100%; width: 350px; padding: 25px 0; background-color:#fff; border-radius: 8px; margin: 0 auto; }
.node-modal.active { visibility: visible; opacity: 1; }
.node-modal.active .node-modal-content {
    animation-name: upDown;
    animation-duration: .4s;
    animation-delay: .2s;
    animation-fill-mode: backwards;
    animation-direction: alternate;
    transform : translateY(200px)
 }

#state-messinger { font-size: 13px; padding-top: 8px; font-weight: bold; }
#state-messinger.error { color: #dc3545 }
#state-messinger.warn { color: #ffb100 }
#state-messinger.default { color: #fff }
#state-messinger.success { color: #007bff }

#passwd_form label { display: block;}
#passwd_form .pd-8 { padding: 8px 0; }

@keyframes upDown {
    100% {
        transform: translateY(200px);
    } 50% {
        transform: translateY(220px);
    } 0% {
        transform: translateY(0px);
    }
}
</style>

<div class="node-modal">
    <div class="node-bg" ></div>
    <div class="node-modal-content">
        <form id="passwd_form">
            <div class='pd-8 text-center'>
                <label for="bb_passwd">* 패스워드를 입력해주세요.</label>
                <input type="password" name="bb_passwd" id="bb_passwd" />
                <input type="hidden" name="id" id="modal-ids" />
                <div id='state-messinger' class='default'></div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">확인</button>
                <button type="button" class="btn btn-secondary modal-close">닫기</button>    
            </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function () {

    var data = {
        ids : undefined,
        page : undefined,
    };

    $(".modal-on").on("click", function () {
        data.ids = $(this).attr("data-ids");
        data.page = $(this).attr("data-page");

        $(".node-modal").addClass("active");
    })

    $(".modal-close, .node-bg").on("click", function () {
        $(".node-modal").removeClass("active");
        $("#bb_passwd").val("");
        state("default","");
    })

    $("#passwd_form").on("submit", function (e) {
        e.preventDefault();

        var me = $(this);

        // $(this) 는 form 선택자를 의미하면 [0] 이 태그자체를 의미한다.
        var passwd = me[0].bb_passwd;

        if (!passwd.value) {
            state("warn", "비밀번호를 작성해주세요.")
            passwd.focus();
            return false;
        }
        
        if (data.ids === undefined) {
            alert("잘못된 경로입니다.");
            return false;
        }

        data.passwd = passwd.value;

        var requestData = {
            url : "passwordDo_async.php",
            method : "POST",
            data : data
        }

        asyncServer(requestData);
    })
})

function state (c, m) {
    $("#state-messinger")[0].className = c;
    $("#state-messinger").text(m)
}

function asyncServer (param) {

    if (typeof param != "object") {
        console.error("Parameter type only Object !!");
        return false;
    }

    $.ajax({
        url : param.url,
        method : param.method,
        data : param.data,
        success : function (data) {
            if (data.type === 200) {
                delete param.data.passwd;
                location.href = "./view.php?page="+data.page+"&id="+data.id;
            } else {
                state("error", data.message);
            }
        },
        error : function (err) {
            console.log(err)
        }
    });
}
</script>