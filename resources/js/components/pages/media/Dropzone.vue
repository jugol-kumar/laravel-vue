<template>
    <div>
        <div class="dropzone">
            <input type="file" id="dropzone-file" class="dropzone-file" multiple>
            <div class="dropzone-wrapper">
                <label for="dropzone-file" class="dropzone-label">
                    <svg xmlns="http://www.w3.org/2000/svg" width="10em" height="10em" fill="currentColor" class="dropzone-label-icon" viewBox="0 0 16 16">
                        <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z"/>
                    </svg>
                    <div class="dropzone-label-text">
                        <p>
                            <strong>Drun ang drops file for upload</strong>
                        </p>
                        <p>
                            <small class="secondary:text">Your files will be added automatically</small>
                        </p>
                        <button type="button" class="btn btn-outline-secondary">or Select Files</button>
                    </div>
                </label>
            </div>
        </div>
    </div>
</template>

<script>
export default {
name: "Dropzone"
}
</script>

<style scoped>

</style>
