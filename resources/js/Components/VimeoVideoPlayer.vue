<template>
  <div class="aspect-w-16 aspect-h-9 bg-gray-800">
    <iframe
        title="vimeo-player"
        :src="`https://player.vimeo.com/video/${videoId}`"
        class="w-full"
        height="400"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        pip="1"
        byline="0"
        portrait="0"
        webkitallowfullscreen
        mozallowfullscreen
        allowfullscreen
    />
  </div>
</template>

<script>
import Player from "@vimeo/player";

export default {
  props: {
    url: {
      type: String
    },
    videoId: {
      type: String
    }
  },
  methods: {
    store(data) {
      console.log(data);
      axios.patch(this.url, data).then(({ data }) => {

      }).catch((err) => {

      });
    }
  },
  mounted() {
    let iframe = document.querySelector('iframe');
    let player = new Player(iframe);
    const self = this;

    player.on('play', (data) => {
      self.store(data);
    });

    player.on('progress', (data) => {
      self.store(data);
    });

    player.on('ended', (data) => {
      self.store(data);
    });

  }
}
</script>