/**
 Based heavily on https://www.shadertoy.com/view/MsjSW3 by nimitz
 https://twitter.com/stormoid

 License: https://creativecommons.org/licenses/by-nc-sa/3.0/deed.en_US
*/

precision mediump float;

uniform float time;
uniform vec2 rez;
uniform float hue;

uniform float timeModZ;
uniform float timeModY;
uniform float complexity;

mat2 m(float a) {
    float c=cos(a), s=sin(a);
    return mat2(c, -s, s, c);
}

float map(vec3 p) {
    p.xz *= m(time * timeModZ);
    p.xy *= m(time * timeModY);
    vec3 q = p * complexity + time;
    return length(p + vec3(sin(time * 0.7))) * log(length(p) + 1.0) + sin(q.x + sin(q.z + sin(q.y))) * 0.5 - 1.0;
}

vec4 rotateHue(vec4 color) {
    float angle = hue * 3.14159265;
    float s = sin(angle), c = cos(angle);
    vec3 weights = (vec3(2.0 * c, -sqrt(3.0) * s - c, sqrt(3.0) * s - c) + 1.0) / 3.0;
    float len = length(color.rgb);
    return vec4(dot(color.rgb, weights.xyz), dot(color.rgb, weights.zxy), dot(color.rgb, weights.yzx), 1.0);
}

void main(){
	vec2 p = gl_FragCoord.xy / rez.y - vec2(0.9, 0.5);
    vec3 cl = vec3(0.0);
    float d = 2.5;
    for(int i=0; i<=5; i++)	{
		vec3 p = vec3(0.0, 0.0, 3.0) + normalize(vec3(p.x, p.y, -1.)) * d;
		p+=vec3(-0.1, 0.0, 0.0);
        float rz = map(p);
		float f = clamp((rz - map(p + 0.1)) * 0.5, -0.1, 1.0);
        vec3 l = vec3(0.1, 0.3, 0.4) + vec3(5.0, 2.5, 3.0) * f;
        cl = cl * l + (1.0 - smoothstep(0., 2.5, rz)) * 0.7 * l;
		d += min(rz, 1.0);
	}

    vec4 color = vec4(cl, 1.0);
    color = rotateHue(color) * vec4(1.0, 0.5, 0.75, 1.0);

    gl_FragColor = color;
}