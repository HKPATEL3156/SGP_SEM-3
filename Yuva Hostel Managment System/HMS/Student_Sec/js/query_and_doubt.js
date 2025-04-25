// query_or_doubt.js

const facilityOptions = document.querySelectorAll('.facility-options input[type="checkbox"]');
const imageBlock = document.getElementById('image-block');
const textBlock = document.getElementById('text-block');
const recordingBlock = document.getElementById('recording-block');

facilityOptions.forEach(option => {
  option.addEventListener('change', () => {
    if (option.id === 'image') {
      imageBlock.style.display = option.checked ? 'block' : 'none';
    } else if (option.id === 'text') {
      textBlock.style.display = option.checked ? 'block' : 'none';
    } else if (option.id === 'recording') {
      recordingBlock.style.display = option.checked ? 'block' : 'none';
    }
  });
});