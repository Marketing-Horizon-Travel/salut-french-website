/**
 * Eleventy config for Salut French website.
 */
module.exports = function (eleventyConfig) {
    // Pass through assets, images, favicon
    eleventyConfig.addPassthroughCopy({ "src/assets": "assets" });

    // Watch CSS/JS for dev reload
    eleventyConfig.addWatchTarget("src/assets/css/");
    eleventyConfig.addWatchTarget("src/assets/js/");

    // Filters
    eleventyConfig.addFilter("slugify", (str) =>
        String(str)
            .toLowerCase()
            .normalize("NFD")
            .replace(/[\u0300-\u036f]/g, "")
            .replace(/đ/g, "d")
            .replace(/[^a-z0-9]+/g, "-")
            .replace(/^-+|-+$/g, "")
    );

    eleventyConfig.addFilter("dateVi", (value) => {
        if (!value) return "";
        const d = value instanceof Date ? value : new Date(value);
        if (isNaN(d)) return value;
        return d.toLocaleDateString("vi-VN", { day: "2-digit", month: "2-digit", year: "numeric" });
    });

    eleventyConfig.addFilter("initial", (s) => (s ? String(s).trim().charAt(0).toUpperCase() : ""));

    eleventyConfig.addFilter("limit", (arr, n) => (Array.isArray(arr) ? arr.slice(0, n) : arr));

    eleventyConfig.addFilter("where", (arr, key, val) =>
        Array.isArray(arr) ? arr.filter((item) => item && item[key] === val) : arr
    );

    // Shortcode: current year
    eleventyConfig.addShortcode("year", () => new Date().getFullYear());

    return {
        dir: {
            input: "src",
            output: "_site",
            includes: "_includes",
            data: "_data",
        },
        templateFormats: ["njk", "html", "md"],
        htmlTemplateEngine: "njk",
        markdownTemplateEngine: "njk",
    };
};
