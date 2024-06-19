import {changeGroupIDToFiled} from "@index/index.js";



// ドラッグ操作を有効化および無効化する関数
export const enableDragging = () => {
    interact('.drag-drop').draggable({
        inertia: true,
        autoScroll: true,
        onstart: function(event) {
            event.target.classList.add('is-dragging');
            // ドラッグ開始時に位置情報をリセット
            event.target.setAttribute('data-x', 0);
            event.target.setAttribute('data-y', 0);
        },
        onmove: function(event) {
            const target = event.target;
            const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
            const y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

            target.style.transform = `translate(${x}px, ${y}px)`;
            target.setAttribute('data-x', x);
            target.setAttribute('data-y', y);

        },
        onend: function(event) {
            event.target.style.transform = '';
            event.target.removeAttribute('data-x');
            event.target.removeAttribute('data-y');
            event.target.classList.remove('is-dragging');
        }
    });
}

// ドラッグ操作を無効化する関数
export const disableDragging = () => {
    const draggableElements = document.querySelectorAll('.drag-drop');
    draggableElements.forEach(element => {
        element.removeAttribute('draggable'); // draggable属性を削除
        element.style.transform = '';
        element.removeAttribute('data-x');
        element.removeAttribute('data-y');
        element.style.left = '';
        element.style.top = '';
    });

    interact('.drag-drop').draggable(false);
};


const getClosestElement = (x, y, elements) => {
    let closestElement = null;
    let closestDistance = Infinity;

    elements.forEach(element => {
        //要素のビューポート内での位置とサイズを取得
        const rect = element.getBoundingClientRect();
        const centerX = rect.left + rect.width / 2;
        const centerY = rect.top + rect.height / 2;
        const distance = Math.sqrt((centerX - x) ** 2 + (centerY - y) ** 2);

        if (distance < closestDistance) {
            closestDistance = distance;
            closestElement = element;
        }
    });

    return closestElement;
}



// 全てのtbodyをドロップゾーンとして設定
interact('.dropzone').dropzone({
    accept: '.drag-drop',
    overlap: 0.50,
    ondrop: function(event) {
        const dragged = event.relatedTarget; // ドラッグされたtr要素

        // ドロップされた位置に最も近いtbodyを探すために座標を取得
        const clientX = event.dragEvent.clientX; // ドラッグイベントからX座標を取得
        const clientY = event.dragEvent.clientY; // ドラッグイベントからY座標を取得

        const targetElements = document.querySelectorAll('.dropzone');
        const dropzone = getClosestElement(clientX, clientY, targetElements);

        // マーカー要素を取得
        const marker = document.getElementById('marker');

        // マーカーの位置を更新
        marker.style.left = `${clientX}px`;
        marker.style.top = `${clientY}px`;
        marker.style.display = 'block'; // マーカーを表示

        if (!dropzone) {
            console.error('適切なドロップゾーンが見つかりませんでした。');
            return; // 適切なドロップゾーンが見つからなければ処理を中断
        }

        const afterElement = getDropPosition(dropzone, dragged);

        console.log(dragged);
        console.log(dropzone);
        if (afterElement) {
            dropzone.insertBefore(dragged, afterElement);
        } else {
            dropzone.appendChild(dragged);
        }
        changeGroupIDToFiled(dropzone, dragged)
    }


});

// ドロップ位置を決定する関数
const getDropPosition = (dropzone, dragged)=> {
    const rows = Array.from(dropzone.querySelectorAll('tr'));
    let afterElement = null;
    const draggedRect = dragged.getBoundingClientRect();

    for (let row of rows) {
        const rect = row.getBoundingClientRect();
        if (draggedRect.top < rect.top) {
            afterElement = row;
            break;
        }
    }

    return afterElement; // ドラッグされた行が末尾に配置される場合はnullを返す
}