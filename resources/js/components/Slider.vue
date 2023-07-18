<template>
    <Splide :options="options" aria-label="My Favorite Images">
        <SplideSlide>
            <img src="@/images/slider7.png" alt="Sample 1" />
        </SplideSlide>
        <SplideSlide>
            <img src="@/images/slider5.jpeg" alt="Sample 2" />
        </SplideSlide>
        <SplideSlide>
            <img src="@/images/slider4.jpeg" alt="Sample 3" />
        </SplideSlide>
        <SplideSlide>
            <img src="@/images/slder6.jpeg" alt="Sample 4" />
        </SplideSlide>
        <SplideSlide>
            <img src="@/images/slider8.jpeg" alt="Sample 5" />
        </SplideSlide>
    </Splide>
</template>

<script>
import { Splide, SplideSlide } from "@splidejs/vue-splide";
import { defineComponent } from "vue";

export default defineComponent({
    components: {
        Splide,
        SplideSlide,
    },

    setup() {
        const options = {
            rewind: true,
            gap: "1rem",
            autoplay: true,
        };

        return { options };
    },
});
</script>
<style lang="scss" scoped>
.splide__slide img {
    width: 100%;
    height: 57rem;
    object-fit: cover;
    margin-top: 1rem;
}
</style>
