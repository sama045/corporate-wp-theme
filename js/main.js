
class TypeWriter {
    constructor(element, words, wait = 3000) {
        this.element = element;
        this.words = words;
        this.txt = '';
        this.wordIndex = 0;
        this.wait = parseInt(wait, 10);
        this.isDeleting = false;
        
        // เริ่มต้นการพิมพ์
        this.type();
    }

    type() {
        // หา Index ของคำปัจจุบัน
        const current = this.wordIndex % this.words.length;
        const fullTxt = this.words[current];

        // ตรวจสอบสถานะการพิมพ์หรือลบ
        if (this.isDeleting) {
            this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
            this.txt = fullTxt.substring(0, this.txt.length + 1);
        }

        // แสดงผลลัพธ์ลงใน DOM
        this.element.innerHTML = `<span id="typer">${this.txt}</span>`;

        // ตั้งค่าความเร็วในการพิมพ์ (ลบจะเร็วกว่าพิมพ์ 2 เท่า)
        let typeSpeed = 100;
        if (this.isDeleting) {
            typeSpeed /= 2;
        }

        // ตรวจสอบเมื่อพิมพ์จบคำ
        if (!this.isDeleting && this.txt === fullTxt) {
            typeSpeed = this.wait; // หยุดพักเมื่อพิมพ์จบคำ
            this.isDeleting = true;
        } 
        // ตรวจสอบเมื่อลบหมดคำ
        else if (this.isDeleting && this.txt === '') {
            this.isDeleting = false;
            this.wordIndex++;
            typeSpeed = 500; // หยุดพักสั้นๆ ก่อนเริ่มคำใหม่
        }

        setTimeout(() => this.type(), typeSpeed);
    }
}

// วิธีเรียกใช้งาน (Init)
document.addEventListener('DOMContentLoaded', () => {
    const textElement = document.querySelector('.type-cursor');
    
    // ต้องเช็กก่อนว่ามีแท็กนี้อยู่ในหน้าเว็บไหม ค่อยดึง Attribute
    // เพื่อป้องกัน Error ในหน้าอื่นๆ ที่ไม่ได้ใช้ลูกเล่นนี้
    if (textElement) {
        // อ่านค่าคำจาก Attribute data-words
        const words = JSON.parse(textElement.getAttribute('data-words'));
        // ดึงค่า wait ถ้าไม่มีให้ตั้งค่า Default เป็น 3000
        const wait = textElement.getAttribute('data-wait') || 3000; 
        
        new TypeWriter(textElement, words, wait);
    }
});

